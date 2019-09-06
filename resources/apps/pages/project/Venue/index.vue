<template>
    <v-page-wrap crud absolute searchable with-progress>
        <template #toolbar-default>
            <v-scale-transition>
                <v-btn icon key="employee" :color="$root.theme" @click="openEmployee" v-show="!disabled.link">
                    <v-icon>assignment_ind</v-icon>
                </v-btn>
            </v-scale-transition>

            <v-scale-transition>
                <v-btn icon key="monetize" :color="$root.theme" @click="openMonetize" v-show="!disabled.link">
                    <v-icon>settings</v-icon>
                </v-btn>
            </v-scale-transition>

            <v-scale-transition>
                <v-btn icon key="itemprice" :color="$root.theme" @click="openItemPrice" v-show="!disabled.link">
                    <v-icon>layers</v-icon>
                </v-btn>
            </v-scale-transition>

            <v-scale-transition>
                <v-btn icon key="package" :color="$root.theme" @click="openPackage" v-show="!disabled.link">
                    <v-icon>gradient</v-icon>
                </v-btn>
            </v-scale-transition>
            
            <v-scale-transition>
                <v-btn icon key="link" :color="$root.theme" @click="openLink" v-show="!disabled.link">
                    <v-icon>photo_filter</v-icon>
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
            { text: 'Karyawan', value: 'employee_count', sortable: false, align: 'end', class: 'count-field' },
            { text: 'Item', value: 'item_count', sortable: false, align: 'end', class: 'count-field' },
            { text: 'Package', value: 'package_count', sortable: false, align: 'end', class: 'count-field' },
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