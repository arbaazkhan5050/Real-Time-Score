<template>
  <div id="matchDetails" class="container">
    <h1>Round Matches:</h1>

    <div class="cards" v-if="matches">
      <div class="card mt-5 mb-5" v-for="(match, index) in matches" :key="index">
        <div class="card-header">
          <h4>Match: {{match.team.name}} VS {{ match.opponent.name }}</h4>
        </div>
        <div class="card-body">
          <pre>{{ match.data }}</pre>
        </div>
      </div>
    </div>
  </div>
</template>

<script lang="ts">
import Vue from "vue";
import Component from "vue-class-component";
import { mapState } from "vuex";

@Component({
  computed: {
    ...mapState(["apiURL", "matches"])
  },
  mounted() {},
  created() {
    this.round_id = this.$route.params.round_id;
    this.getMatches();
    this.matchRunner = setInterval(this.runMatches, 100);
  },
  beforeDestroy() {
    clearInterval(this.matchRunner);
  }
})
export default class MatchDetails extends Vue {
  round_id: number;
  matchRunner: any;
  matchEvents = [
    { name: "run", actor: "batsman" },
    { name: "bowled", actor: "bowlewr" },
    { name: "caught", actor: "bowlewr" },
    { name: "no-ball", actor: "bowlewr" },
    { name: "lbw", actor: "bowlewr" }
  ];

  runs = [0, 1, 2, 3, 4, 5, 6];

  maxBowls = 20 * 6;

  getMatches() {
    this.$store.dispatch("getMatches", this.round_id).then(() => {
      for (let i = 0; i < this.matches.length; i++) {
        this.$set(this.matches[i], "innings", 0);
        this.$set(this.matches[i], "currentInning", 1);
        this.$set(this.matches[i], "balls", 0);
        this.$set(this.matches[i], "batsman", null);
        this.$set(this.matches[i], "bowler", null);
        this.setupLineup(this.matches[i]);
      }
    });
  }

  setupLineup(match: any) {
    let team = match.team;
    let opponent = match.opponent;

    let teamPlayers = [];
    let opponentPlayers = [];

    for (let i = 0; i < team.members.length; i++) {
      teamPlayers.push(team.members[i].player);
    }

    for (let i = 0; i < opponent.members.length; i++) {
      opponentPlayers.push(opponent.members[i].player);
    }

    match.teamPlayers = teamPlayers;
    match.opponentPlayers = opponentPlayers;
  }

  runMatches() {
    console.log("running");
    if (this.matches.length) {
      for (let i = 0; i < this.matches.length; i++) {
        let match = this.matches[i];

        if (match.balls >= this.maxBowls / 2) {
          match.innings = 1;
          match.currentInning = 2;
        } else if (match.balls == this.maxBowls) {
          match.innings = 2;
          match.currentInning = 2;
        }

        this.getRandomBatsman(match);

        if (match.balls <= this.maxBowls) {
          let action = this.getRandomEvent();
          switch (action.name) {
            case "run":
              let randomRun = this.getRandomRun();
              if (!match.batsman.out) {
                match.batsman.balls_played++;
              }
              match.data.push({
                action: "run",
                amount: randomRun
              });
              this.addBatsManData(match.batsman, match);
              match.balls++;
              break;

            case "bowled":
            case "caught":
            case "lbw":
              match.data.push({
                action: action.name
              });
              match.balls++;
              break;

            case "no-ball":
              match.data.push({
                action: "run",
                amount: 1
              });
              break;

            default:
              match.data.push({
                action: "run",
                amount: 0
              });
              match.balls++;
              break;
          }
        }
      }
    }
  }

  getRandomEvent() {
    return this.matchEvents[
      Math.floor(Math.random() * this.matchEvents.length)
    ];
  }

  getRandomRun() {
    return this.runs[Math.floor(Math.random() * this.runs.length)];
  }

  getRandomBatsman(match) {
    if (typeof match.batsman == "undefined" || match.batsman == null) {
      let batsman = null;

      if (match.currentInning < 2) {
        batsman =
          match.teamPlayers[
            Math.floor(Math.random() * match.teamPlayers.length)
          ];
      } else {
        batsman =
          match.opponentPlayers[
            Math.floor(Math.random() * match.teamPlayers.length)
          ];
      }
      batsman.out = false;
      batsman.runs = 0;
      batsman.ballsPlayed = 0;
      match.batsman = batsman;
    }
  }

  addBatsManData(batsman: any, match: any) {
    if (batsman && match) {
      if (match.currentInning < 2) {
        let index = match.teamPlayers.indexOf(batsman);
        match.teamPlayers[index].ballsPlayed = batsman.ballsPlayed;
        match.teamPlayers[index].out = batsman.out;
        match.teamPlayers[index].runs = batsman.runs;
      }
    }
  }
}
</script>
