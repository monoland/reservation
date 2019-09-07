<template>
    <v-page-wrap crud absolute searchable with-progress>
        <template #navigate>
            <v-btn icon @click="$router.go(-1)">
                <v-icon>arrow_back</v-icon>
            </v-btn>
        </template>
        
        <template #toolbar-default>
            <v-btn-tips @click="openCustomers" label="pelanggan" icon="spa" :show="!disabled.link" />
            <v-btn-tips @click="openLink" label="kecamatan" icon="photo_filter" :show="!disabled.link" />
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
            { text: 'Nama Kota/Kabupaten', value: 'name' },
            { text: 'Kecamatan', value: 'districts_count', align: 'center', sortable: false, class: 'number-field' },
            { text: 'Pelanggan', value: 'customers_count', align: 'center', sortable: false, class: 'number-field' },
            { text: 'Updated', value: 'updated_at', class: 'datetime-field' }
        ]);

        this.pageInfo({
            icon: 'whatshot',
            title: 'Kota/Kabupaten',
        });

        this.dataUrl(`/api/province/${this.$route.params.province}/regency`);

        this.setRecord({
            id: null,
            name: null,
            province: {},
            province_id: this.$route.params.province
        });
    },

    methods: {
        openLink: function() {
            this.$router.push({ name: 'district', params: { regency: this.record.id } });
        },

        openCustomers: function() {
            this.$router.push({ name: 'customer', query: { filterBy: this.record.id, filterOn: 'regency' } });
        }
    }
};
</script>