<template>
    <v-page-wrap crud absolute searchable with-progress>
        <template #toolbar-default>
            <v-btn-tips @click="openLink" label="scan-data" icon="g_translate" :show="!disabled.link" />
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
                    label="Nama Item"
                    :color="$root.theme"
                    v-model="record.name"
                ></v-text-field>
            </v-flex>

            <v-flex xs12>
                <v-text-field
                    label="Keterangan"
                    :color="$root.theme"
                    v-model="record.describe"
                ></v-text-field>
            </v-flex>

            <v-flex xs12>
                <v-switch
                    label="Item ini gratis"
                    :color="$root.theme"
                    v-model="record.free"
                ></v-switch>
            </v-flex>
            
        </v-page-form>
    </v-page-wrap>
</template>

<script>
import { pageMixins } from '@apps/mixins/PageMixins';

export default {
    name: 'page-item',

    mixins: [pageMixins],

    data:() => ({
        // 
    }),

    created() {
        this.tableHeaders([
            { text: 'Nama', value: 'name' },
            { text: 'Keterangan', value: 'describe', class: 'long-field' },
            { text: 'Updated', value: 'updated_at', class: 'datetime-field' }
        ]);

        this.pageInfo({
            icon: 'people',
            title: 'Item',
        });

        this.dataUrl(`/api/item`);

        this.setRecord({
            id: null,
            name: null,
            describe: null,
            free: false
        });
    },

    methods: {
        openLink: function() {
            this.$router.push({ name: 'item-scan', params: { item: this.record.id } });
        },
    }
};
</script>