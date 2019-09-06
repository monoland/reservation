<template>
    <v-page-wrap crud absolute searchable with-progress>
        <template #toolbar-default>
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
                    <v-list-item-subtitle class="f-nunito">{{ item.email }}</v-list-item-subtitle>
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

            <v-flex xs8>
                <v-text-field
                    label="Alamat Email"
                    :color="$root.theme"
                    v-model="record.email"
                ></v-text-field>
            </v-flex>

            <v-flex xs4>
                <v-text-field
                    label="Hanphone"
                    :color="$root.theme"
                    v-model="record.phone"
                ></v-text-field>
            </v-flex>
        </v-page-form>
    </v-page-wrap>
</template>

<script>
import { pageMixins } from '@apps/mixins/PageMixins';

export default {
    name: 'page-manager',

    mixins: [pageMixins],

    data:() => ({
        // 
    }),

    created() {
        this.tableHeaders([
            { text: 'Nama', value: 'name' },
            { text: 'Email', value: 'email' },
            { text: 'Telpon', value: 'phone' },
            { text: 'Updated', value: 'updated_at', class: 'datetime-field' }
        ]);

        this.pageInfo({
            icon: 'people',
            title: 'Manager',
        });

        this.dataUrl(`/api/employee`);

        this.setRecord({
            id: null,
            name: null,
            email: null,
            phone: null,
            role: 'manager'
        });

        this.setFilter({
            filterBy: 'manager',
            filterOn: 'role'
        });
    },

    methods: {
        openLink: function() {
            this.$router.push({ name: 'marketing', params: { manager: this.record.id } });
        },
    }
};
</script>