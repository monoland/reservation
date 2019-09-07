<template>
    <v-page-wrap crud absolute searchable with-progress>
        <template #navigate>
            <v-btn icon @click="$router.go(-1)" v-if="$route.query.hasOwnProperty('filterBy')">
                <v-icon>arrow_back</v-icon>
            </v-btn>
        </template>
        
        <v-desktop-table v-if="desktop"
            single
        ></v-desktop-table>

        <v-mobile-table icon="perm_identity" v-else>
            <template v-slot:default="{ item }">
                <v-list-item-content>
                    <v-list-item-title>{{ item.name }}</v-list-item-title>
                    <v-list-item-subtitle class="f-nunito">{{ item.email }}</v-list-item-subtitle>
                </v-list-item-content>
            </template>
        </v-mobile-table>

        <v-page-form small>
            <v-flex xs8>
                <v-text-field
                    label="Nama Lengkap"
                    :color="$root.theme"
                    v-model="record.name"
                ></v-text-field>
            </v-flex>

            <v-flex xs4>
                <v-combobox
                    label="Segmen"
                    :items="segments"
                    :color="$root.theme"
                    v-model="record.segment"
                ></v-combobox>
            </v-flex>

            <v-flex xs12>
                <v-textarea
                    label="Alamat"
                    :color="$root.theme"
                    v-model="record.address"
                ></v-textarea>
            </v-flex>

            <v-flex xs4>
                <v-combobox
                    autocomplete="off"
                    label="Propinsi"
                    :items="provinces"
                    :color="$root.theme"
                    v-model="record.province"
                ></v-combobox>
            </v-flex>

            <v-flex xs4>
                <v-combobox
                    autocomplete="off"
                    label="Kota/Kabupaten"
                    :items="regencies"
                    :color="$root.theme"
                    v-model="record.regency"
                ></v-combobox>
            </v-flex>

            <v-flex xs4>
                <v-combobox
                    autocomplete="off"
                    label="Kecamatan"
                    :items="districts"
                    :color="$root.theme"
                    v-model="record.district"
                ></v-combobox>
            </v-flex>

            <v-flex xs4>
                <v-text-field
                    label="Telepon"
                    :color="$root.theme"
                    v-model="record.phone"
                ></v-text-field>
            </v-flex>

            <v-flex xs4>
                <v-text-field
                    label="Nama Kontak"
                    :color="$root.theme"
                    v-model="record.contact_name"
                ></v-text-field>
            </v-flex>

            <v-flex xs4>
                <v-text-field
                    label="Telpon Kontak"
                    :color="$root.theme"
                    v-model="record.contact_phone"
                ></v-text-field>
            </v-flex>

            <v-flex xs8>
                <v-text-field
                    label="Email"
                    :color="$root.theme"
                    v-model="record.email"
                ></v-text-field>
            </v-flex>

            <v-flex xs4>
                <v-combobox
                    label="Label"
                    :items="labels"
                    :color="$root.theme"
                    v-model="record.label"
                ></v-combobox>
            </v-flex>

            <v-flex xs12 v-if="auth.authent === 'manager'">
                <div class="d-block text-uppercase caption">pemeriksaan manager</div>
            </v-flex>

            <v-flex xs12 v-if="auth.authent === 'manager'">
                <v-switch
                    label="Data pelanggan telah di periksa"
                    v-model="record.checked"
                    inset
                ></v-switch>
            </v-flex>
        </v-page-form>
    </v-page-wrap>
</template>

<script>
import { pageMixins } from '@apps/mixins/PageMixins';

export default {
    name: 'page-customer',

    mixins: [pageMixins],

    computed: {
        labels: function() {
            if (this.additional && this.additional.hasOwnProperty('labels')) {
                return this.additional.labels;
            }

            return [];
        },
        
        segments: function() {
            if (this.additional && this.additional.hasOwnProperty('segments')) {
                return this.additional.segments;
            }

            return [];
        },

        provinces: function() {
            if (this.additional && this.additional.hasOwnProperty('provinces')) {
                return this.additional.provinces;
            }

            return [];
        }
    },

    data:() => ({
        regencies: [],
        districts: [],
    }),

    created() {
        this.tableHeaders([
            { text: 'Nama', value: 'name' },
            { text: 'Segment', value: 'segment.text' },
            { text: 'Marketing', value: 'marketing.text' },
            { text: 'Kontak', value: 'contact_name' },
            { text: 'Phone', value: 'contact_phone' },
            { text: 'Updated', value: 'updated_at', class: 'datetime-field' }
        ]);

        this.pageInfo({
            icon: 'people',
            title: 'Pelanggan',
        });

        this.dataUrl(`/api/customer`);

        this.setRecord({
            id: null,
            name: null,
            address: null,
            segment: null,
            label: null,
            marketing: null,
            regency: null,
            province: null,
            district: null,
            contact_name: null,
            contact_phone: null,
            phone: null,
            email: null,
            checked: false
        });

        if (this.$route.query.hasOwnProperty('filterBy')) {
            this.setFilter({
                filterBy: parseInt(this.$route.query.filterBy),
                filterOn: this.$route.query.filterOn
            });
        }
    },

    mounted() {
        this.$store.commit('allow', { addnew: this.auth.authent === 'marketing' });
    },

    methods: {
        fetchRegency: async function(province) {
            try {
                let { data } = await this.http.get(`/api/province/${province.value}/regency/combo`);

                this.regencies = data;
            } catch (error) {
                this.$store.dispatch('errors', error);
            }
        },

        fetchDistrict: async function(district) {
            try {
                let { data } = await this.http.get(`/api/regency/${district.value}/district/combo`);

                this.districts = data;
            } catch (error) {
                this.$store.dispatch('errors', error);
            }
        },
    },

    watch: {
        'record.province': function(newVal) {
            if (newVal) this.fetchRegency(newVal);
        },

        'record.regency': function(newVal) {
            if (newVal) this.fetchDistrict(newVal);
        }
    }
};
</script>