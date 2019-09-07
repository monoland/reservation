<template>
    <v-page-wrap crud absolute searchable with-progress>
        <template #navigate>
            <v-btn icon @click="$router.go(-1)">
                <v-icon>arrow_back</v-icon>
            </v-btn>
        </template>
        
        <template #toolbar-default>
            <v-btn-tips @click="openCustomers" label="pelanggan" icon="spa" :show="!disabled.link" />
        </template>

        <v-desktop-table v-if="desktop"
            single
        ></v-desktop-table>

        <v-mobile-table icon="perm_identity" v-else>
            <template v-slot:default="{ item }">
                <v-list-item-content>
                    <v-list-item-title>{{ item.name }}</v-list-item-title>
                    <v-list-item-subtitle class="f-nunito">{{ item.province.name }}</v-list-item-subtitle>
                </v-list-item-content>
            </template>
        </v-mobile-table>

        <v-page-form small>
            <v-flex sm6 xs6>
                <v-text-field
                    label="Id"
                    :color="$root.theme"
                    v-model="record.id"
                ></v-text-field>
            </v-flex>

            <v-flex sm6 xs6>
                <v-text-field
                    label="Text"
                    :color="$root.theme"
                    v-model="record.name"
                ></v-text-field>
            </v-flex>
        </v-page-form>
    </v-page-wrap>
</template>

<script>
import { pageMixins } from '@apps/mixins/PageMixins';

export default {
    name: 'page-regency',

    mixins: [pageMixins],

    data:() => ({
        // 
    }),

    created() {
        this.tableHeaders([
            { text: 'Nama Kecamatan', value: 'name' },
            { text: 'Pelanggan', value: 'customers_count', align: 'center', sortable: false, class: 'number-field' },
            { text: 'Updated', value: 'updated_at', class: 'datetime-field' }
        ]);

        this.pageInfo({
            icon: 'whatshot',
            title: 'Kecamatan',
        });

        this.dataUrl(`/api/regency/${this.$route.params.regency}/district`);

        this.setRecord({
            id: null,
            name: null,
            regency: {},
            regency_id: this.$route.params.regency
        });
    },

    methods: {
        openCustomers: function() {
            this.$router.push({ name: 'customer', query: { filterBy: this.record.id, filterOn: 'district' } });
        }
    }
};
</script>