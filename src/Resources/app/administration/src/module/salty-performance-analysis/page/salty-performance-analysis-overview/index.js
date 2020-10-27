import template from './salty-performance-analysis-overview.html.twig';
import { Component } from 'src/core/shopware';

Component.register('salty-performance-analysis-overview', {
    template,

    inject: [
        'SaltyPerformanceAnalysisService',
    ],

    data() {
        return {
            shopwareConfigurationInformation: [],
            serverConfigurationInformation: [],
        }
    },

    created() {
        this.createComponent();
    },

    computed: {
        gridColumns() {
            return this.getColumns();
        },

        isLoading() {
            return this.serverConfigurationInformation.length === 0;
        }
    },

    methods: {
        createComponent() {
            this.getShopwareConfigurationInformation();
        },

        getColumns() {
           return [
               {
                   property: 'status',
                   label: 'Status',
                   rawData: true
               },
               {
                   property: 'name',
                   label: 'Name',
                   rawData: true
               },
               {
                   property: 'suggestedValue',
                   label: 'Empfohlen',
                   rawData: true
               },
               {
                   property: 'value',
                   label: 'Value',
                   rawData: true
               },
               {
                   property: 'information',
                   label: 'Information',
                   rawData: true
               },

           ]
        },

        getShopwareConfigurationInformation() {
            this.SaltyPerformanceAnalysisService.getServerConfigurationInformation().then(response => {
                this.serverConfigurationInformation = response;
            });

            this.SaltyPerformanceAnalysisService.getShopwareConfigurationInformation().then(response => {
                this.shopwareConfigurationInformation = response;
            });
        }
    },
});
