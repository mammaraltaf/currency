// store.js
import { defineStore } from 'pinia';

export const useSortingStore = defineStore('sorting', {
  state: () => ({
    column: 'code',
    type: 'asc',
  }),
  actions: {
    sortValues(column) {
      if (this.column === column) {
        this.type = this.type === 'asc' ? 'desc' : 'asc';
      } else {
        this.column = column;
        this.type = 'asc';
      }
    },
  },
});
