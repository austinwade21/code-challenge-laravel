<template>
    <application>
        <template v-slot:content>
            <v-container class="pa-4" fluid>
                <v-card>
                    <v-card-title>
                        Settings
                    </v-card-title>
                    <v-card-text>
                        <v-select
                            :items="items"
                            filled
                            label="Dark Mode"
                            hint="Darkens the application's user interface."
                            persistent-hint
                            @change="handleChange"
                        />
                    </v-card-text>
                </v-card>
            </v-container>
        </template>
    </application>
</template>

<script>
  import store from '../store';

  export default {
    data: () => ({
        items: [
            { text: 'Enabled', value: true },
            { text: 'Disabled', value: false }
        ]
    }),
    methods: {
        handleChange(value) {
            console.log('handle change', value);
            store.commit('settings/setDarkMode', value);
            this.$vuetify.theme.dark = value;
        }
    }
  }
</script>
