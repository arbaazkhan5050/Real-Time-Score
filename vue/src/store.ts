import Vue from "vue";
import Vuex from "vuex";
import axios from "axios";

Vue.use(Vuex);

export default new Vuex.Store({
  state: {
    apiURL: process.env.VUE_APP_API_URL,
    teams: [],
    round_id: localStorage.getItem("round_id"),
    matches: []
  },
  mutations: {},
  actions: {
    /**
     * Loads a list of teams via AJAX
     * @param context $store
     */
    loadTeams(context) {
      return new Promise((resolve, reject) => {
        axios
          .get(this.state.apiURL + "teams")
          .then(resp => {
            context.state.teams = resp.data.data; // yeah, thank the Transformers
            resolve(resp.data.data);
          })
          .catch(err => {
            reject(err);
          });
      });
    },
    /**
     * Sets the round_id to localStorage and the state
     * @param context
     * @param id
     */
    setRoundId(context, id) {
      localStorage.setItem("round_id", id);
      this.state.round_id = id;
    },
    /**
     * Starts a new round in the back-end with the teams
     * @param context
     * @param teams an array of teams
     */
    startRound(context, teams) {
      return new Promise((resolve, reject) => {
        axios
          .post(context.state.apiURL + "rounds", { teams: teams })
          .then(resp => {
            context.state.round_id = resp.data.round_id;
            context.state.matches = resp.data.matches;
            resolve(resp.data);
          })
          .catch(err => {
            reject(err);
          });
      });
    },

    getMatches(context, round_id) {
      return new Promise((resolve, reject) => {
        const url = this.state.apiURL + "round/" + round_id + "/matches";

        axios
          .get(url)
          .then(resp => {
            context.state.matches = resp.data.data;
            resolve(resp.data.data);
          })
          .catch(err => {
            reject(err);
          });
      });
    }

    //
  }
});
