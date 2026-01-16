import { defineStore } from 'pinia'
import axios from 'axios';
export const globalStore = defineStore('global', {
  state: () => ({
    counter: 0,
    user: {},
    isLoggedIn: !!localStorage.getItem('token'),
    }),
  getters: {
    doubleCount: (state) => state.counter * 2
  },
  actions: {
    increment () {
      this.counter++
    }
  }
})