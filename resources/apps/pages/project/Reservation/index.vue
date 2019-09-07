<template>
    <v-page-wrap crud absolute searchable with-progress>
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

        <v-page-form large>
            <v-flex sm8>
                <v-combobox
                    label="Pelanggan"
                    item-text="name"
                    item-value="id"
                    :loading="customerLoading"
                    :items="customers"
                    :search-input.sync="customerSearch"
                    v-model="record.customer"
                    hide-no-data
                    hide-details
                ></v-combobox>
            </v-flex>

            <v-flex sm4>
                <v-combobox
                    label="Segment"
                    :color="$root.theme"
                    :items="segmentSubs"
                    :disabled="customerNull"
                    v-model="record.segment_sub"
                    hide-details
                ></v-combobox>
            </v-flex>

            <v-flex sm4>
                <v-text-field
                    label="Nama Kontak"
                    :color="$root.theme"
                    :disabled="customerNull"
                    v-model="record.contact_name"
                    hide-details
                ></v-text-field>
            </v-flex>

            <v-flex sm4>
                <v-text-field
                    label="Nomor HP"
                    :color="$root.theme"
                    :disabled="customerNull"
                    v-model="record.contact_phone"
                    hide-details
                ></v-text-field>
            </v-flex>

            <v-flex sm4>
                <v-combobox
                    label="Pemasaran"
                    :color="$root.theme"
                    :items="marketings"
                    :disabled="customerNull"
                    v-model="record.marketing"
                    hide-details
                ></v-combobox>
            </v-flex>

            <v-flex sm8>
                <v-combobox
                    label="Lokasi"
                    :color="$root.theme"
                    :items="venues"
                    :disabled="customerNull"
                    v-model="record.venue"
                    hide-details
                ></v-combobox>
            </v-flex>

            <v-flex sm3>
                <v-menu offset-y>
                    <template v-slot:activator="{ on }">
                        <v-text-field v-on="on"
                            label="Tanggal Mulai"
                            :color="$root.theme"
                            :disabled="pricelistNull"
                            v-model="record.date_str"
                            readonly
                            hide-details
                        ></v-text-field>
                    </template>

                    <v-date-picker v-model="record.date_str" no-title :readonly="record.locked"></v-date-picker>
                </v-menu>
            </v-flex>

            <v-flex xs1>
                <v-text-field
                    label="Jam"
                    :color="$root.theme"
                    :disabled="pricelistNull"
                    :readonly="record.locked"
                    v-model="record.time_str"
                    hide-details
                ></v-text-field>
            </v-flex>

            <v-flex sm7>
                <v-text-field
                    label="Nama Event"
                    :color="$root.theme"
                    :disabled="pricelistNull"
                    :readonly="record.locked"
                    v-model="record.name"
                ></v-text-field>
            </v-flex>

            <v-flex sm1>
                <v-text-field
                    class="text-xs-right"
                    label="Peserta"
                    :color="$root.theme"
                    :disabled="pricelistNull"
                    :readonly="record.locked"
                    v-model="record.participants"
                ></v-text-field>
            </v-flex>

            <v-flex sm3>
                <v-menu offset-y>
                    <template v-slot:activator="{ on }">
                        <v-text-field v-on="on"
                            label="Tanggal Akhir"
                            :color="$root.theme"
                            :disabled="pricelistNull"
                            v-model="record.date_end"
                            readonly
                        ></v-text-field>
                    </template>

                    <v-date-picker v-model="record.date_end" no-title :readonly="record.locked"></v-date-picker>
                </v-menu>
            </v-flex>

            <v-flex sm1>
                <v-text-field
                    label="Jam"
                    :color="$root.theme"
                    :disabled="pricelistNull"
                    :readonly="record.locked"
                    v-model="record.time_end"
                ></v-text-field>
            </v-flex>

            <v-flex xs12 class="pb-0">
                <div class="d-block">Detail Pesanan</div>
            </v-flex>

            <v-flex sm8>
                <v-combobox
                    item-text="name"
                    item-value="id"
                    :label="`${isPackage ? 'Paket' : 'Item'} Pesanan`"
                    :color="$root.theme"
                    :items="isPackage ? packagePrices : itemPrices"
                    :disabled="pricelistNull"
                    :readonly="record.locked"
                    v-model="record.item"
                    hide-details
                >
                    <template v-slot:prepend>
                        <v-scale-transition mode="out-in">
                            <v-icon
                                :key="`icon-${isPackage}`"
                                :color="$root.theme"
                                :disabled="pricelistNull"
                                @click="isPackage = !isPackage; record.item = null"
                                v-text="isPackage ? 'hot_tub' : 'layers'"
                            ></v-icon>
                        </v-scale-transition>
                    </template>
                </v-combobox>
            </v-flex>

            <v-flex sm3>
                <v-number-field
                    label="Harga"
                    :color="$root.theme"
                    :disabled="pricelistNull"
                    :readonly="record.locked"
                    v-model="record.price"
                    hide-details
                ></v-number-field>
            </v-flex>

            <v-flex sm1>
                <v-text-field
                    class="align-right"
                    label="Qty"
                    :color="$root.theme"
                    :disabled="pricelistNull"
                    :readonly="record.locked"
                    v-model="record.qty"
                    hide-details
                ></v-text-field>
            </v-flex>

            <v-flex xs12>
                <v-textarea 
                    label="Catatan"
                    :color="$root.theme"
                    :rows="1"
                    :disabled="pricelistNull"
                    :readonly="record.locked"
                    v-model="record.note"
                    hide-details
                    auto-grow
                >
                    <template v-slot:append-outer>
                        <v-icon :disabled="pricelistNull" color="deep-orange" @click="detailAdd">add</v-icon>
                    </template>
                </v-textarea>
            </v-flex>

            <v-flex xs12 class="pb-6">
                <v-simple-table class="v-data-table__detail">
                    <thead>
                        <tr>
                            <th class="text-left pl-0">Jenis Pesanan</th>
                            <th class="text-right pr-2 money-field">Qty</th>
                            <th class="text-right pr-2 money-field">Harga</th>
                            <th class="text-right pr-2 money-field">Total</th>
                            <th class="text-right icon-field"></th>
                        </tr>
                    </thead>

                    <tbody v-if="record.details && record.details.length > 0">
                        <tr v-for="(item, index) in record.details" :key="index">
                            <td class="text-left pl-0">{{ item.name }}</td>
                            <td class="text-right pr-2 money-field">{{ item.qty }}</td>
                            <td class="text-right pr-2 money-field">{{ $root.formatCurrency(item.price) }}</td>
                            <td class="text-right pr-2 money-field">{{ $root.formatCurrency(item.amount) }}</td>
                            <td class="text-right pa-0">
                                <v-icon small @click="detailRemove(index)">remove_circle_outline</v-icon>
                            </td>
                        </tr>
                    </tbody>

                    <tbody v-else>
                        <tr>
                            <td class="text-center grey--text" colspan="5">No data available</td>
                        </tr>
                    </tbody>
                </v-simple-table>

                <v-divider></v-divider>
            </v-flex>

            <v-flex xs8>
                <div class="d-block">Catatan Pesanan:</div>
                <div class="b-block mt-4" v-html="notes"></div>
            </v-flex>

            <v-flex xs4>
                <v-layout row wrap>
                    <v-flex xs12>
                        <v-number-field
                            class="align-right"
                            label="Subtotal"
                            :color="$root.theme"
                            :disabled="pricelistNull"
                            v-model="record.subtotal"
                            hide-details
                            readonly
                        ></v-number-field>
                    </v-flex>
                    
                    <v-flex xs12>
                        <v-number-field
                            class="align-right"
                            label="Diskon"
                            :color="$root.theme"
                            :disabled="pricelistNull"
                            :readonly="record.locked"
                            v-model="record.discount"
                            hide-details
                        ></v-number-field>
                    </v-flex>

                    <v-flex xs12>
                        <v-number-field
                            class="align-right"
                            label="Total Budget"
                            :color="$root.theme"
                            :disabled="pricelistNull"
                            v-model="record.totalbudget"
                            hide-details
                            readonly
                        ></v-number-field>
                    </v-flex>

                    <v-flex xs12>
                        <v-number-field
                            class="align-right"
                            label="Pajak"
                            :color="$root.theme"
                            :disabled="pricelistNull"
                            :readonly="record.locked"
                            v-model="record.tax"
                            hide-details
                        ></v-number-field>
                    </v-flex>
                    
                    <v-flex xs12>
                        <v-number-field
                            class="align-right"
                            label="Grand Total"
                            :color="$root.theme"
                            :disabled="pricelistNull"
                            :readonly="record.locked"
                            v-model="record.grandtotal"
                        ></v-number-field>
                    </v-flex>
                </v-layout>
            </v-flex>
        </v-page-form>
    </v-page-wrap>
</template>

<script>
import { debounce } from 'debounce';
import { pageMixins } from '@apps/mixins/PageMixins';

export default {
    name: 'page-manager',

    mixins: [pageMixins],

    computed: {
        customerNull: function() {
            return this.record.customer === null;
        },

        pricelistNull: function() {
            return this.pricelists.length === 0;
        },

        segmentSubs: function() {
            if (this.additional && this.additional.hasOwnProperty('segmentSubs')) {
                return this.additional.segmentSubs;
            }

            return [];
        },

        marketings: function() {
            if (this.additional && this.additional.hasOwnProperty('marketings')) {
                return this.additional.marketings;
            }

            return [];
        },

        venues: function() {
            if (this.additional && this.additional.hasOwnProperty('venues')) {
                return this.additional.venues;
            }

            return [];
        },

        packagePrices: function() {
            if (this.pricelists && this.pricelists.length > 0) {
                return this.pricelists.filter(item => {
                    return item.type === 'package'
                });
            }

            return [];
        },

        itemPrices: function() {
            if (this.pricelists && this.pricelists.length > 0) {
                return this.pricelists.filter(item => {
                    return item.type === 'single'
                });
            }

            return [];
        },

        notes: function() {
            if (!this.record.hasOwnProperty('details')) return null;

            return this.record.details.reduce((text, item) => {
                if (item.note) { 
                    return text + item.note + '</br>'
                } else {
                    return text;
                }
            }, '');
        }
    },

    data:() => ({
        customers: [],
        customerLoading: false,
        customerSearch: null,
        isPackage: true,
        pricelists: [],
        trainers: []
    }),

    created() {
        this.tableHeaders([
            { text: 'Pelanggan', value: 'customer.name' },
            { text: 'Peserta', value: 'participants', class: 'count-field' },
            { text: 'Mulai', value: 'event_str', class: 'event-field' },
            { text: 'Akhir', value: 'event_end', class: 'event-field' },
            { text: 'Lokasi', value: 'venue.text' },
            { text: 'Status', value: 'status' },
            { text: 'Kunci', value: 'locked', sortable: false, align: 'center', class: 'count-field' },
            { text: 'Updated', value: 'updated_at', class: 'datetime-field' }
        ]);

        this.pageInfo({
            icon: 'event_seat',
            title: 'Reservasi',
        });

        this.dataUrl(`/api/reservation`);

        this.setRecord({
            id: null,
            name: null,
            date_str: null,
            date_end: null,
            time_str: null,
            time_end: null,
            event_str: null,
            event_end: null,
            participants: null,
            contact_name: null,
            contact_phone: null,
            subtotal: 0,
            discount: 0,
            totalbudget: 0,
            tax: 0,
            grandtotal: 0,
            status: null,
            locked: false,
            bookfee: false,
            dpayment: false,
            rpayment: false,
            marketing: null,
            marketing_id: null,
            customer: null,
            customer_id: null,
            venue: null,
            venue_id: null,
            segment_sub: null,
            segment_sub_id: null,
            segment_id: null,
            followups_count: 0,
            feedback: null,
            reason: null,
            
            trainers: [],
            details: [],
            item: null,
            price: 0,
            qty: 0,
            note: null
        });

        this.setAfterFormClose(() => {
            this.$nextTick(() => {
                this.$store.commit('record', {})
            }, 1000);
        });
    },

    methods: {
        bouncingCustomer: debounce(function (value) {
            this.fetchCustomers(value);
        }, 750),

        fetchCustomers: async function(value) {
            let params = { 
                itemsPerPage: 25, 
                page: 1, 
                search: value,
                mode: 'checked'
            };

            try {
                this.customerLoading = true;

                let { data: { data }} = await this.http.get( 
                    '/api/customer', { params }
                );

                this.customers = data;
                this.customerLoading = false;
            } catch (error) {
                this.$store.dispatch('errors', error);
            }
        },

        fetchPricelist: async function(value) {
            if (this.record.segment_sub && this.record.segment_sub.hasOwnProperty('value')) {
                let params = { filterBy: this.record.segment_sub.value, filterOn: 'segment_sub_id' };
                
                try {
                    let { data: { data }} = await this.http.get( 
                        `/api/venue/${value}/pricelist`, { params }
                    );

                    this.pricelists = data;
                } catch (error) {
                    this.$store.dispatch('errors', error);
                }
            } else {
                this.pricelists = [];
            }
        },

        fetchTrainer: async function(value) {
            try {
                let params = { filterBy: 'trainer', filterOn: 'role' };

                let { data: { data }} = await this.http.get( 
                    `/api/venue/${value}/employee`, { params }
                );

                this.trainers = data;
            } catch (error) {
                this.$store.dispatch('errors', error);
            }
        },

        detailSum: function() {
            if (this.record.details && this.record.details.constructor === Array) {
                this.record.subtotal = this.record.details.reduce((previous, current) => {
                    return parseInt(previous) + parseInt(current.amount);
                }, 0);
                this.record.totalbudget = parseInt(this.record.subtotal) - parseInt(this.record.discount);
                this.record.tax = parseInt(parseInt(this.record.totalbudget) * (10/100));
                this.record.grandtotal = parseInt(this.record.totalbudget) + parseInt(this.record.tax);
            } else {
                this.record.subtotal = 0;
                this.record.discount = 0;
                this.record.totalbudget = 0;
                this.record.tax = 0;
                this.record.grandtotal = 0;
            }
        },

        detailAdd: function() {
            let idx = this.record.details.findIndex(obj => obj.id === this.record.item.id);

            if (idx === -1) {
                let note = this.record.note ? 
                    '<strong>'+ this.record.item.name +'</strong></br> ' + this.record.note.replace(/\n/g, '</br>') :
                    null;
                
                let newItem = Object.assign({
                    qty: this.record.qty,
                    price: parseInt(this.record.price),
                    amount: parseInt(this.record.qty) * parseInt(this.record.price),
                    note: note
                }, this.record.item);

                this.record.details.push(newItem);
                this.detailSum();
            }

            this.record.item = null;
            this.record.price = 0;
            this.record.qty = 0;
            this.record.note = null;
        },

        detailRemove: function(idx) {
            this.record.details.splice(idx, 1);
            this.detailSum();
        }
    },

    watch: {
        customerSearch: function(searchVal) {
            this.bouncingCustomer(searchVal)
        },

        'record.discount': function(newVal) {
            if (newVal && parseInt(newVal) > 0) {
                this.record.totalbudget = parseInt(this.record.subtotal) - parseInt(newVal);
                this.record.tax = parseInt(parseInt(this.record.totalbudget) * (10/100));
                this.record.grandtotal = parseInt(this.record.totalbudget) + parseInt(this.record.tax);   
            }
        },

        'record.item': function(newVal) {
            if (newVal && Object.keys(newVal).length) {
                this.record.price = newVal.sprice;
                this.record.qty = this.record.participants ? parseInt(this.record.participants) : 1;
            }
        },

        'record.customer': function(newVal) {
            if (newVal && newVal.hasOwnProperty('segment_sub')) {
                this.record.customer_id = newVal.id;
                this.record.segment_sub = newVal.segment_sub;
                this.record.contact_name = newVal.contact_name;
                this.record.contact_phone = newVal.contact_phone;
                this.record.marketing = newVal.marketing;
            }
        },

        'record.segment_sub': function(newVal) {
            if (newVal && newVal.hasOwnProperty('value')) {
                this.record.segment_sub_id = newVal.value;
                this.record.segment_id = newVal.segment_id;
            }  
        },

        'record.marketing': function(newVal) {
            if (newVal && newVal.hasOwnProperty('value')) {
                this.record.marketing_id = newVal.value;
            }
        },

        'record.venue': function(newVal) {
            if (newVal && newVal.hasOwnProperty('value')) {
                this.record.venue_id = newVal.value;
                this.fetchPricelist(newVal.value);
                this.fetchTrainer(newVal.value);
            }
        }
    }
};
</script>