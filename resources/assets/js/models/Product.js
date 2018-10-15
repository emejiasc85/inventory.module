class Product {
    static get(params, then) {
        axios.get('/api/products', {
            params: params
        })
        .then(({data}) => then(data));
    }

    static store(data, then, error) {
        axios.post('/api/products', data)
            .then(({data}) => then(data))
            .catch(({response}) => error(response.data.errors));
    }

    static update(element, data, then, error) {
        axios.post('/api/products/' + element, data)
            .then(({data}) => then(data))
            .catch(({response}) => error(response.data.errors));
    }

    static destroy(element, then) {
        axios.delete('/api/products/' + element)
            .then(({data}) => then(data));
    }

}

export default Product;