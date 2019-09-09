<template>
    <v-page-wrap absolute with-progress>
        <template #navigate>
            <v-btn icon @click="$router.go(-1)">
                <v-icon>arrow_back</v-icon>
            </v-btn>
        </template>

        <v-widget table>
            <v-data-table
                v-model="table.selected"
                :headers="headers"
                :items="itemlinks"
                :single-select="true"
                item-key="id"
                show-select
            >
                <template #:progress>
                    <v-progress-linear :color="color" height="1" indeterminate></v-progress-linear>
                </template>

                <template v-slot:item.bprice="{ value }">{{ $root.formatCurrency(value) }}</template>
                <template v-slot:item.mprice="{ value }">{{ $root.formatCurrency(value) }}</template>
                <template v-slot:item.sprice="{ value }">{{ $root.formatCurrency(value) }}</template>
            </v-data-table>
        </v-widget>
    </v-page-wrap>
</template>

<script>
import { pageMixins } from '@apps/mixins/PageMixins';

export default {
    name: 'page-item-scan',

    mixins: [pageMixins],

    created() {
        this.tableHeaders([
            { text: 'Nama', value: 'name' },
            { text: 'Type', value: 'type' },
            { text: 'Lokasi', value: 'venue.text' },
            { text: 'Segmen', value: 'segment.text' },
            { text: 'Harga Dasar', value: 'bprice', align: 'end', class: 'percent-field' },
            { text: 'Monetize', value: 'mprice', align: 'end', class: 'percent-field' },
            { text: 'Harga Jual', value: 'sprice', align: 'end', class: 'percent-field' },
            { text: 'Updated', value: 'updated_at', class: 'datetime-field' }
        ]);

        this.pageInfo({
            icon: 'people',
            title: 'Item Scan',
        });
    },

    data:() => ({
        itemlinks: []
    }),

    mounted() {
        this.fetchData(`/api/item/${this.$route.params.item}/prices`);
        this.fetchData(`/api/item/${this.$route.params.item}/pricelists`);
    },

    methods: {
        fetchData: async function(dataurl) {
            try {
                let { data } = await this.http.get(dataurl);

                data.forEach(record => {
                    this.itemlinks.push(record);
                });
            } catch (error) {
                this.$store.dispatch('errors', error);
            }
        }
    }
}
</script>