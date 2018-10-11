class Stock {
    static get(params, then) {
        axios.get('/api/stock', {
            params: params
        })
        .then(({data}) => then(data));
    }
}

export default Stock;