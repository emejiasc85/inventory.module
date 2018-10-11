class GiftCard {
    static get(params, then) {
        axios.get('/api/commerces', {
            params: params
        })
        .then(({data}) => then(data));
    }
    static show(element, params, then) {
        axios.get('/api/commerces/'+element, {
            params: params
        })
        .then(({data}) => then(data));
    }
}

export default GiftCard;