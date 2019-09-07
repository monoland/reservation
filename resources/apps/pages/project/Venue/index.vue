<template>
    <v-page-wrap crud absolute searchable with-progress>
        <template #toolbar-default>
            <v-btn-tips @click="openEmployee" label="karyawan" icon="assignment_ind" :show="!disabled.link" />
            <v-btn-tips @click="openMonetize" label="monetize" icon="settings" :show="!disabled.link" />
            <v-btn-tips @click="openItemPrice" label="harga-item" icon="layers" :show="!disabled.link" />
            <v-btn-tips @click="openPackage" label="harga-paket" icon="gradient" :show="!disabled.link" />
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
                    label="Nama Lokasi"
                    :color="$root.theme"
                    v-model="record.name"
                ></v-text-field>
            </v-flex>

            <v-flex xs12>
                <v-textarea
                    label="Alamat"
                    :color="$root.theme"
                    v-model="record.address"
                ></v-textarea>
            </v-flex>
        </v-page-form>
    </v-page-wrap>
</template>

<script>
import { pageMixins } from '@apps/mixins/PageMixins';

export default {
    name: 'page-venue',

    mixins: [pageMixins],

    data:() => ({
        // 
    }),

    created() {
        this.tableHeaders([
            { text: 'Nama Lokasi', value: 'name' },
            { text: 'Karyawan', value: 'employees_count', sortable: false, align: 'center', class: 'count-field' },
            { text: 'Monetize', value: 'monetizes_count', sortable: false, align: 'center', class: 'count-field' },
            { text: 'Pricelist', value: 'pricelists_count', sortable: false, align: 'center', class: 'count-field' },
            { text: 'Package', value: 'packages_count', sortable: false, align: 'center', class: 'count-field' },
            { text: 'Updated', value: 'updated_at', class: 'datetime-field' }
        ]);

        this.pageInfo({
            icon: 'whatshot',
            title: 'Lokasi',
        });

        this.dataUrl(`/api/venue`);

        this.setRecord({
            id: null,
            name: null,
            address: null,
        });
    },

    methods: {
        openLink: function() {
            this.$router.push({ name: 'regency', params: { venue: this.record.id } });
        },

        openEmployee: function() {
            this.$router.push({ name: 'employee', params: { venue: this.record.id } });
        },

        openMonetize: function() {
            this.$router.push({ name: 'monetize', params: { venue: this.record.id } });
        },

        openItemPrice: function() {
            this.$router.push({ name: 'itemprice', params: { venue: this.record.id } });
        },

        openPackage: function() {
            this.$router.push({ name: 'package', params: { venue: this.record.id } });
        },
    }
};
</script>