class ProductOrderReport {
    static get(params, then) {
        axios.get('/api/admin/reports/product-orders', {
            params: params
        })
        .then(({data}) => then(data));
    }

    static store(data, then, error) {
        axios.post('/api/admin/reports/product-orders', data)
            .then(({data}) => then(data))
            .catch(({response}) => error(response.data.errors));
    }

    static update(element, data, then, error) {
        axios.put('/api/admin/reports/product-orders/' + element, data)
            .then(({data}) => then(data))
            .catch(({response}) => error(response.data.errors));
    }

    static show(element, then) {
        axios.get('/api/admin/reports/product-orders/' + element)
            .then(({data}) => then(data));
    }

    static destroy(element, then) {
        axios.delete('/api/admin/reports/product-orders/' + element)
            .then(({data}) => then(data));
    }

}

export default ProductOrderReport;