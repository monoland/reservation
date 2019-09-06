<template>
    <v-page-wrap crud absolute searchable with-progress>
        <template #navigate>
            <v-btn icon @click="$router.go(-1)">
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
                <v-combobox
                    label="Segmen"
                    :items="segments"
                    :color="$root.theme"
                    v-model="record.segment"
                ></v-combobox>
            </v-flex>

            <v-flex xs4>
                <v-select
                    label="Type"
                    :items="types"
                    :color="$root.theme"
                    v-model="record.type"
                ></v-select>
            </v-flex>

            <v-flex md4>
                <v-number-field
                    label="Ops. Unit"
                    :color="$root.theme"
                    :precision=1
                    suffix="%"
                    v-model="record.operational"
                ></v-number-field>
            </v-flex>

            <v-flex md4>
                <v-number-field
                    label="Fasilitas"
                    :color="$root.theme"
                    :precision=1
                    suffix="%"
                    v-model="record.facility"
                ></v-number-field>
            </v-flex>

            <v-flex md4>
                <v-number-field
                    label="Ops. Marketing"
                    :color="$root.theme"
                    :precision=1
                    suffix="%"
                    v-model="record.salary"
                ></v-number-field>
            </v-flex>

            <v-flex md4>
                <v-number-field
                    label="Margin"
                    :color="$root.theme"
                    :precision=1
                    suffix="%"
                    v-model="record.margin"
                ></v-number-field>
            </v-flex>

            <v-flex md4>
                <v-number-field
                    label="Diskon"
                    :color="$root.theme"
                    :precision=1
                    suffix="%"
                    v-model="record.discount"
                ></v-number-field>
            </v-flex>

            <v-flex md4>
                <v-number-field
                    label="Komisi"
                    :color="$root.theme"
                    :precision=1
                    suffix="%"
                    v-model="record.commission"
                    disabled
                ></v-number-field>
            </v-flex>

            <v-flex md4>
                <v-number-field
                    label="Manager Fee"
                    :color="$root.theme"
                    :precision=1
                    suffix="%"
                    v-model="record.managerfee"
                ></v-number-field>
            </v-flex>

            <v-flex md4>
                <v-number-field
                    label="Market Fee"
                    :color="$root.theme"
                    :precision=1
                    suffix="%"
                    v-model="record.marketfee"
                ></v-number-field>
            </v-flex>

            <v-flex md4>
                <v-number-field
                    label="Unit Fee"
                    :color="$root.theme"
                    :precision=1
                    suffix="%"
                    v-model="record.venuefee"
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

        commission: function() {
            return parseFloat(parseFloat(this.record.marketfee) + parseFloat(this.record.managerfee) + parseFloat(this.record.venuefee)).toFixed(1)
        }
    },

    data:() => ({
        types: [
            { text: 'Item', value: 'item' },
            { text: 'Paket', value: 'package' },
        ]
    }),

    created() {
        this.tableHeaders([
            { text: 'Segmen', value: 'segment.text', sortable: false },
            { text: 'Type', value: 'type', sortable: false },
            { text: 'Ops. Unit', value: 'operational', align: 'end', class: 'percent-field' },
            { text: 'Fasilitas', value: 'facility', align: 'end', class: 'percent-field' },
            { text: 'Salari', value: 'salary', align: 'end', class: 'percent-field' },
            { text: 'Margin', value: 'margin', align: 'end', class: 'percent-field' },
            { text: 'Diskon', value: 'discount', align: 'end', class: 'percent-field' },
            { text: 'Komisi', value: 'commission', align: 'end', class: 'percent-field' },
            { text: 'Updated', value: 'updated_at', class: 'datetime-field' }
        ]);

        this.pageInfo({
            icon: 'people',
            title: 'Monetize',
        });

        this.dataUrl(`/api/venue/${this.$route.params.venue}/monetize`);

        this.setRecord({
            id: null,
            operational: 0,
            facility: 0,
            salary: 0,
            margin: 0,
            discount: 0,
            commission: 0,
            marketfee: 0,
            managerfee: 0,
            venuefee: 0,
            segment: null,
            type: null
        });
    },

    watch: {
        commission: function(newVal) {
            this.record.commission = newVal;
        }
    }
};
</script>