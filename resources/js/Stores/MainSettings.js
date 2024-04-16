// @ts-check
import { defineStore } from 'pinia'

export const mainSettings = defineStore({
    id: 'mainSettings',
    state: () => ({
        clients: {
            buyers: {},
            buyer_managers: {},
            sellers: {},
            addresses: {},
            marina_clients: {},
        },
        vehicles: {},
        drivers: {},
        deliveries: {
            discounts: {}
        }
    }),
    persist: true,
    actions: {

    },
})
