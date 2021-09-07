<template>
    <default-field :field="field" :errors="errors" :show-help-text="showHelpText">
        <template slot="field">
            <input :id="field.name" class="hidden" v-model="value" />
            <autocomplete :placeholder="field.name" :aria-label="field.name" :search="search"
                :get-result-value="getResultValue" :default-value="this.field.value" @submit="handleSubmit">
            </autocomplete>
        </template>
    </default-field>
</template>

<script>
    import "@trevoreyre/autocomplete-vue/dist/style.css";
    import Autocomplete from "@trevoreyre/autocomplete-vue";
    import {
        FormField,
        HandlesValidationErrors
    } from "laravel-nova";

    const nominatimUrl = "https://nominatim.openstreetmap.org/";

    export default {
        mixins: [FormField, HandlesValidationErrors],

        props: ["resourceName", "resourceId", "field"],

        components: {
            Autocomplete,
        },

        data() {
            return {
                inputPlace: "",
                linkCountry: []
            };
        },

        watch: {
            inputPlace: {
                deep: true,
                handler() {
                    this.value = this.inputPlace || this.value;
                },
            },
        },

        mounted() {
            Nova.$on(this.field.dependent_field + "-change", (event) => {
                this.setLinkCountry(event);
            });
        },

        methods: {
            /*
             * Set the initial, internal value for the field.
             */
            setInitialValue() {
                this.value = this.field.value || "";
            },

            /*
             * Set celected country code.
             */
            setLinkCountry(value) {
                this.linkCountry = [value];
            },

            /**
             * Fill the given FormData object with the field's internal value.
             */
            fill(formData) {
                formData.append(this.field.attribute, this.value || "");
            },

            search(input) {
                let search_type = this.field.type;
                let linkCountry = this.linkCountry ?
                    this.linkCountry :
                    '';
                let selectCountryCodes = this.field.countrycodes ?
                    this.field.countrycodes :
                    ''
                let countrycodes = linkCountry.concat(selectCountryCodes).filter((v, i, a) => a.indexOf(v) === i);

                const query = `${search_type}=${encodeURI(input)}&format=json&countrycodes=${countrycodes}`;

                const url =
                    `${nominatimUrl}search?${query}`;

                return new Promise((resolve) => {
                    if (input.length < 3) {
                        return resolve([]);
                    }

                    fetch(url)
                        .then((response) => response.json())
                        .then((data) => {
                            resolve(data);
                        });
                });
            },

            getResultValue(result) {
                return result.display_name;
            },

            handleSubmit(result) {
                this.inputPlace = result.display_name;
            },
        },
    };

</script>
