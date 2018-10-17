class QuickOrder {

    static store(element, data, then, error) {
        axios.post('/api/products/'+element+'/quick-orders', data)
            .then(({data}) => then(data))
            .catch(({response}) => error(response.data.errors));
    }
}

export default QuickOrder;