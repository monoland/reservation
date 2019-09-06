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
            <v-flex md8 xs12>
                <v-text-field
                    label="Nama Lengkap"
                    :color="$root.theme"
                    v-model="record.name"
                ></v-text-field>
            </v-flex>

            <v-flex md4 xs12>
                <v-select
                    label="Peran"
                    :items="roles"
                    :color="$root.theme"
                    v-model="record.role"
                ></v-select>
            </v-flex>

            <v-flex md8 xs12>
                <v-text-field
                    label="Alamat Email"
                    :color="$root.theme"
                    v-model="record.email"
                ></v-text-field>
            </v-flex>

            <v-flex md4 xs12>
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
    name: 'page-employee',

    mixins: [pageMixins],

    data:() => ({
        roles: [
            { text: 'Office', value: 'office' },
            { text: 'Trainer', value: 'trainer' }
        ],
    }),

    created() {
        this.tableHeaders([
            { text: 'Nama', value: 'name' },
            { text: 'Email', value: 'email' },
            { text: 'Telpon', value: 'phone' },
            { text: 'Peran', value: 'role' },
            { text: 'Updated', value: 'updated_at', class: 'datetime-field' }
        ]);

        this.pageInfo({
            icon: 'people',
            title: 'Karyawan',
        });

        this.dataUrl(`/api/venue/${this.$route.params.venue}/employee`);

        this.setRecord({
            id: null,
            name: null,
            email: null,
            phone: null,
            role: null
        });
    }
};
</script>