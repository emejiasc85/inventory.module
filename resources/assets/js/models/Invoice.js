class Invoice {
    static get(params, then) {
        axios.get('/api/invoice', {
            params: params
        })
        .then(({data}) => then(data));
    }

    static store(data, then, error) {
        axios.post('/api/invoice', data)
            .then(({data}) => then(data))
            .catch(({response}) => error(response.data.errors));
    }

    static update(element, data, then, error) {
        axios.post('/api/invoice/' + element, data)
            .then(({data}) => then(data))
            .catch(({response}) => error(response.data.errors));
    }

    static destroy(element, data, then) {
        axios.delete('/api/invoice/' + element, data)
            .then(({data}) => then(data));
    }

    static storeGiftCard(element, data, then, error) {
        axios.post('/api/invoice/'+element+'/gift-cards', data)
            .then(({data}) => then(data))
            .catch(({response}) => error(response.data.errors));
    }

    static removeGiftCard(element, params, then) {
        axios.delete('/api/invoice/'+element+'/gift-cards', {data: params})
            .then(({data}) => then(data));
    }

}

export default Invoice;