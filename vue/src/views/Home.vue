<template>
  <div id="home" class="container">
    <div class="row justify-content-center mt-5">
      <div id="listOfTeams" class="col-8">
        <h1 class="text-center">{{ headerText }}</h1>

        <b-card
          class="mt-4"
          :title="'Select Teams: ' + selectedTeams.length + '/' + maxSelection"
          v-if="teams"
        >
          <div class="form-group" v-for="(team, index) in teams" :key="index">
            <label :for="'team_' + team.id">
              <input
                type="checkbox"
                :id="'team_' + team.id"
                :value="team.id"
                v-model="selectedTeams"
                :disabled="selectedTeams.length >=maxSelection && selectedTeams.indexOf(team.id) == -1 "
              >
              {{ team.name }}
              <i class="fas" :class="'fa-' + team.icon"></i>
            </label>
          </div>
          <div class="form-group">
            <button
              class="btn btn-primary"
              :disabled="selectedTeams.length < maxSelection || startingRound"
              @click="startRound"
            >
              <i class="fa fa-cog" :class="{ 'fa-spin' : startingRound }"></i>
              {{ startingRound ? 'Starting' : 'Start'}}
            </button>
          </div>
        </b-card>
      </div>
    </div>
  </div>
</template>

<script lang="ts">
import { Component, Vue } from "vue-property-decorator";
import { mapState } from "vuex";

@Component({
  computed: {
    ...mapState(["apiURL", "teams", "round_id", "matches"])
  },
  components: {},
  mounted() {
    this.$store.dispatch("loadTeams");
  }
})
export default class Home extends Vue {
  selectedTeams: any[] = [];
  maxSelection = 8;
  headerText: string = "Start Round 1";
  working: boolean = false;
  startingRound: boolean = false;

  startRound() {
    if (this.maxSelection == this.selectedTeams.length) {
      this.startingRound = true;
      this.$store
        .dispatch("startRound", this.selectedTeams)
        .then(data => {
          this.$router.push({
            name: "matches",
            params: {
              round_id: data.round_id
            }
          });
        })
        .catch(error => {
          console.log(error);
        })
        .finally(() => {
          this.startingRound = false;
        });
    }
  }

  //
}
</script>
