Nova.booting((Vue, router, store) => {
  Vue.component('index-place-input', require('./components/IndexField'))
  Vue.component('detail-place-input', require('./components/DetailField'))
  Vue.component('form-place-input', require('./components/FormField'))
})
