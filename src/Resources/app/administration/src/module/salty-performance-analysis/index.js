import './page/salty-performance-analysis-overview';
import deDE from './snippet/de-DE.json';
import enGB from './snippet/en-GB.json';

Shopware.Module.register('salty-performance-analysis', {
    type: 'plugin',
    name: 'Performance Analysis',
    title: 'Custom module',
    description: 'Description for your custom module',
    color: '#62ff80',
    icon: 'default-object-lab-flask',

    snippets: {
        'de-DE': deDE,
        'en-GB': enGB
    },

    routes: {
        overview: {
            component: 'salty-performance-analysis-overview',
            path: 'overview'
        }
    },

    navigation: [{
        label: 'Custom Module',
        color: '#62ff80',
        path: 'salty.performance.analysis.overview',
        icon: 'default-object-lab-flask'
    }]
});
