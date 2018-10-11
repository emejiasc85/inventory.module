class GiftCard {
    static get(params, then) {
        axios.get('/api/gift-cards', {
            params: params
        })
        .then(({data}) => then(data));
    }

    static store(data, then, error) {
        axios.post('/api/gift-cards', data)
            .then(({data}) => then(data))
            .catch(({response}) => error(response.data.errors));
    }

    static destroy(element, then) {
        axios.delete('/api/gift-cards/' + element)
            .then(({data}) => then(data));
    }

}

export default GiftCard;