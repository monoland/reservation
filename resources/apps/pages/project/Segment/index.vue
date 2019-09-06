<template>
    <v-page-wrap crud absolute searchable with-progress>
        <template #toolbar-default>
            <v-scale-transition>
                <v-btn icon key="link" :color="$root.theme" @click="openCustomers" v-show="!disabled.link">
                    <v-icon>spa</v-icon>
                </v-btn>
            </v-scale-transition>
        </template>

        <v-desktop-table v-if="desktop"
            single
        ></v-desktop-table>

        <v-mobile-table icon="perm_identity" v-else>
            <template v-slot:default="{ item }">
                <v-list-item-content>
                    <v-list-item-title>{{ item.name }}</v-list-item-title>
                    <v-list-item-subtitle class="f-nunito">update: {{ item.updated_at }}</v-list-item-subtitle>
                </v-list-item-content>
            </template>
        </v-mobile-table>

        <v-page-form small>
            <v-flex xs12>
                <v-text-field
                    label="Nama Lengkap"
                    :color="$root.theme"
                    v-model="record.name"
                ></v-text-field>
            </v-flex>

            <v-flex xs12>
                <v-select
                    label="Group Segmen"
                    :items="modes"
                    :color="$root.theme"
                    v-model="record.mode"
                ></v-select>
            </v-flex>
        </v-page-form>
    </v-page-wrap>
</template>

<script>
import { pageMixins } from '@apps/mixins/PageMixins';

export default {
    name: 'page-segment',

    mixins: [pageMixins],

    data:() => ({
        modes: [
            { text: 'Sekolah', value: 'school' },
            { text: 'Non-Sekolah', value: 'general' }
        ]
    }),

    created() {
        this.tableHeaders([
            { text: 'Nama', value: 'name' },
            { text: 'Group', value: 'mode', class: 'medium-field' },
            { text: 'Pelanggan', value: 'customers', align: 'center', sortable: false, class: 'number-field' },
            { text: 'Updated', value: 'updated_at', class: 'datetime-field' }
        ]);

        this.pageInfo({
            icon: 'people',
            title: 'Segment',
        });

        this.dataUrl(`/api/segment`);

        this.setRecord({
            id: null,
            name: null,
            mode: null
        });
    },

    methods: {
        openCustomers: function() {
            this.$router.push({ name: 'customer', query: { filterBy: this.record.id, filterOn: 'segment' } });
        }
    }
};
</script>