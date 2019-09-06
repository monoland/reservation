<template>
    <v-page-wrap crud absolute searchable with-progress>
        <template #navigate>
            <v-btn icon @click="$router.go(-1)">
                <v-icon>arrow_back</v-icon>
            </v-btn>
        </template>

        <v-widget table v-if="desktop">
            <v-data-table
                v-model="table.selected"
                :headers="headers"
                :items="records"
                :single-select="true"
                :loading="table.loader"
                :options.sync="table.options"
                :server-items-length="table.total"
                :footer-props="table.footerProps"
                item-key="id"
                show-select
            >
                <template #:progress>
                    <v-progress-linear :color="color" height="1" indeterminate></v-progress-linear>
                </template>

                <template v-slot:item.bprice="{ value }">{{ $root.formatCurrency(value) }}</template>
                <template v-slot:item.ops_plus="{ value }">{{ $root.formatCurrency(value) }}</template>
                <template v-slot:item.mrg_plus="{ value }">{{ $root.formatCurrency(value) }}</template>
                <template v-slot:item.sprice="{ value }">{{ $root.formatCurrency(value) }}</template>
            </v-data-table>
        </v-widget>

        <v-mobile-table icon="perm_identity" v-else>
            <template v-slot:default="{ item }">
                <v-list-item-content>
                    <v-list-item-title>{{ item.name }}</v-list-item-title>
                    <v-list-item-subtitle class="f-nunito">{{ item.email }}</v-list-item-subtitle>
                </v-list-item-content>
            </template>
        </v-mobile-table>

        <v-page-form small>
            <v-flex sm8>
                <v-text-field
                    label="Nama Paket"
                    :color="$root.theme"
                    v-model="record.name"
                    hide-details
                ></v-text-field>
            </v-flex>

            <v-flex sm4>
                <v-combobox
                    label="Segment"
                    :items="segments"
                    :color="$root.theme"
                    v-model="record.segment"
                    hide-details
                ></v-combobox>
            </v-flex>

            <v-flex sm8>
                <v-combobox
                    label="Item/Segmen"
                    :items="items"
                    :color="$root.theme"
                    :disabled="hasrole"
                    v-model="record.item"
                    
                ></v-combobox>
            </v-flex>

            <v-flex sm4>
                <v-number-field
                    label="Harga Dasar"
                    append-icon="add"
                    @click:append="detailAdd"
                    :color="$root.theme"
                    :disabled="hasrole"
                    v-model="record.unit"
                    
                ></v-number-field>
            </v-flex>

            <v-flex xs12 class="pt-0">
                <v-simple-table class="v-data-table__detail">
                    <thead>
                        <tr>
                            <th class="text-left pl-0">Nama Item</th>
                            <th class="text-right pr-2">Harga</th>
                            <th class="text-right icon-field"></th>
                        </tr>
                    </thead>

                    <tbody v-if="record.details && record.details.length > 0">
                        <tr v-for="(item, index) in record.details" :key="index">
                            <td class="text-left pl-0">{{ item.text }}</td>
                            <td class="text-right pr-2">{{ $root.formatCurrency(item.price) }}</td>
                            <td class="text-right pa-0">
                                <v-icon small @click="detailRemove(index)">remove_circle_outline</v-icon>
                            </td>
                        </tr>
                    </tbody>

                    <tbody v-else>
                        <tr>
                            <td class="text-center grey--text" colspan="3">No data available</td>
                        </tr>
                    </tbody>
                </v-simple-table>
                <v-divider></v-divider>
            </v-flex>

            <v-flex sm4>
                <v-number-field
                    label="Harga Jual"
                    :color="$root.theme"
                    :disabled="hasrole"
                    v-model="record.sprice"
                ></v-number-field>
            </v-flex>

            <v-flex sm4></v-flex>

            <v-flex sm4>
                <v-number-field
                    label="Harga Dasar"
                    :color="$root.theme"
                    :disabled="hasrole"
                    v-model="record.bprice"
                ></v-number-field>
            </v-flex>

            <v-flex md4>
                <v-number-field
                    class="align-right"
                    label="Operasional"
                    :color="$root.theme"
                    :disabled="hasrole"
                    :hint="pricerole.operational ? `${pricerole.operational}%` : ``"
                    persistent-hint
                    v-model="record.operational"
                ></v-number-field>
            </v-flex>

            <v-flex md4>
                <v-number-field
                    class="align-right"
                    label="Fasilitas"
                    :color="$root.theme"
                    :disabled="hasrole"
                    :hint="pricerole.facility ? `${pricerole.facility}%` : ``"
                    persistent-hint
                    v-model="record.facility"
                ></v-number-field>
            </v-flex>

            <v-flex md4>
                <v-number-field
                    class="align-right"
                    label="Marketing"
                    :color="$root.theme"
                    :disabled="hasrole"
                    :hint="pricerole.salary ? `${pricerole.salary}%` : ``"
                    persistent-hint
                    v-model="record.salary"
                ></v-number-field>
            </v-flex>

            <v-flex md4>
                <v-number-field
                    class="align-right"
                    label="Margin"
                    :color="$root.theme"
                    :disabled="hasrole"
                    :hint="pricerole.margin ? `${pricerole.margin}%` : ``"
                    persistent-hint
                    v-model="record.margin"
                ></v-number-field>
            </v-flex>

            <v-flex md4>
                <v-number-field
                    class="align-right"
                    label="Diskon"
                    :color="$root.theme"
                    :disabled="hasrole"
                    :hint="pricerole.discount ? `${pricerole.discount}%` : ``"
                    persistent-hint
                    v-model="record.discount"
                ></v-number-field>
            </v-flex>

            <v-flex md4>
                <v-number-field
                    class="align-right"
                    label="Komisi"
                    :color="$root.theme"
                    :disabled="hasrole"
                    :hint="pricerole.commission ? `${pricerole.commission}%` : ``"
                    persistent-hint
                    v-model="record.commission"
                ></v-number-field>
            </v-flex>
        </v-page-form>
    </v-page-wrap>
</template>

<script>
import { pageMixins } from '@apps/mixins/PageMixins';

export default {
    name: 'page-monetize',

    mixins: [pageMixins],

    computed: {
        segments: function() {
            if (this.additional && this.additional.hasOwnProperty('segments')) {
                return this.additional.segments;
            }

            return [];
        },

        hasrole: function() {
            if (this.pricerole && this.pricerole.constructor === Object) {
                return Object.keys(this.pricerole).length === 0;
            }

            return true;
        },
    },

    data:() => ({
        items: [],
        pricerole: {},
    }),

    created() {
        this.tableHeaders([
            { text: 'Nama', value: 'name' },
            { text: 'Segment', value: 'segment.text', sortable: false },
            { text: 'Modal', value: 'bprice', align: 'end', class: 'percent-field' },
            { text: 'Oprsnl+', value: 'ops_plus', sortable: false, align: 'end', class: 'percent-field' },
            { text: 'Margin+', value: 'mrg_plus', sortable: false, align: 'end', class: 'percent-field' },
            { text: 'Harga', value: 'sprice', align: 'end', class: 'percent-field' },
            { text: 'Updated', value: 'updated_at', class: 'datetime-field' }
        ]);

        this.pageInfo({
            icon: 'people',
            title: 'Harga Paket',
        });

        this.dataUrl(`/api/venue/${this.$route.params.venue}/pricelist`);

        this.setRecord({
            id: null,
            name: null,
            type: 'package',
            bprice: 0,
            operational: 0,
            facility: 0,
            salary: 0,
            margin: 0,
            discount: 0,
            commission: 0,
            sprice: 0,
            item: null,
            unit: 0,
            segment: null,
            details: []
        });

        this.setFilter({
            filterBy: 'package',
            filterOn: 'type'
        });

        this.setAfterFormClose(() => {
            this.$store.commit('record', {});
        });
    },

    methods: {
        fetchMonetize: async function(segment) {
            try {
                let { data } = await this.http.get(`/api/venue/${this.$route.params.venue}/monetize/fetch`, 
                    { params: {
                        segment: segment.value,
                        type: 'package'
                    }
                });
                
                this.pricerole = data;
            } catch (error) {
                this.pricerole = {};
                this.$store.dispatch('errors', error);
            }
        },

        fetchItemPrice: async function(segment) {
            try {
                let { data } = await this.http.get(`/api/venue/${this.$route.params.venue}/pricelist/fetch`, 
                    { params: {
                        segment: segment.value,
                        type: 'item'
                    }
                });

                this.items = data;
            } catch (error) {
                this.$store.dispatch('errors', error);
            }
        },

        detailSum: function() {
            if (this.record.details && this.record.details.constructor === Array) {
                this.record.bprice = this.record.details.reduce((previous, current) => {
                    return parseInt(previous) + parseInt(current.price);
                }, 0);
            } else {
                this.record.bprice = 0;
            }
        },

        detailAdd: function() {
            let idx = this.record.details.findIndex(obj => obj.value === this.record.item.value);

            if (idx === -1) {
                let item = Object.assign({}, this.record.item);
                    item.price = this.record.unit;

                this.record.details.push(item);
            }

            this.record.item = null;
            this.record.unit = 0;
            this.detailSum();
        },

        detailRemove: function(idx) {
            this.record.details.splice(idx, 1);
            this.detailSum();
        }
    },

    watch: {
        'record.bprice': function(newVal) {
            let baseprice = parseInt(newVal);
            let operational = parseInt((parseFloat(this.pricerole.operational) / 100) * parseFloat(newVal));
            let facility = parseInt((parseFloat(this.pricerole.facility) / 100) * parseFloat(newVal));
            let salary = parseInt((parseFloat(this.pricerole.salary) / 100) * parseFloat(newVal));
            let margin = parseInt((parseFloat(this.pricerole.margin) / 100) * parseFloat(newVal));
            let discount = parseInt((parseFloat(this.pricerole.discount) / 100) * parseFloat(newVal));
            let commission = parseInt((parseFloat(this.pricerole.commission) / 100) * parseFloat(newVal));

            this.record.operational = operational;
            this.record.facility = facility;
            this.record.salary = salary;
            this.record.margin = margin;
            this.record.discount = discount;
            this.record.commission = commission;
            this.record.sprice = baseprice + operational + facility + salary + margin + discount + commission;
        },

        'record.item': {
            handler: function(newVal) {
                if (newVal && newVal.hasOwnProperty('value')) {
                    this.record.unit = newVal.price;
                }
            },

            deep: true
        },

        'record.segment': {
            handler: function(newVal) {
                if (newVal && newVal.hasOwnProperty('value')) {
                    this.fetchMonetize(newVal);
                    this.fetchItemPrice(newVal);
                }
            },

            deep: true
        }
    }
};
</script>