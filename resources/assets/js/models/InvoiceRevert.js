class InvoiceRevert {
    static update(element, data, then, error) {
        axios.put('/api/invoices/'+element+'/reverts', data)
            .then(({data}) => then(data))
            .catch(({response}) => error(response.data.errors));
    }
}
export default InvoiceRevert;