class InvoiceDetail {
    static get(params, then) {
        axios.get('/api/invoice-details', {
            params: params
        })
        .then(({data}) => then(data));
    }

    static store(data, then, error) {
        axios.post('/api/invoice-details', data)
            .then(({data}) => then(data))
            .catch(({response}) => error(response.data.errors));
    }

    static update(element, data, then, error) {
        axios.post('/api/invoice-details/' + element, data)
            .then(({data}) => then(data))
            .catch(({response}) => error(response.data.errors));
    }

    static destroy(element, then) {
        axios.delete('/api/invoice-details/' + element)
            .then(({data}) => then(data));
    }



}

export default InvoiceDetail;