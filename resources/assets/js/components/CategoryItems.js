import React, {Component} from 'react'


class CategoryItems extends Component
{
    constructor(props)
    {
        super(props);

        this.state = {
            category : null,
            items: [],
            endPoint : '/api/items'
        };

        this.getItems = this.getItems.bind(this);
    }

    componentWillMount()
    {
        this.getItems();
    }

    componentWillReceiveProps(nextProps)
    {
        this.getItems(nextProps.category);
    }

    getItems(category = null)
    {
        let endPoint = this.state.endPoint;
        if(category !== null)
            endPoint = '/api/categories/'+category.id+'/items';

        axios.get(endPoint)
            .then(({data})=>{
                this.setState({items : data.data,category : category});
                console.log(this.state.category)
            })
            .catch((res)=>{
                console.log(res)
            });
        console.log(this.state.items)
    }

    renderItems()
    {
        return this.state.items.map((item,key) => {
            return (
                <tr key={item.id}>
                    <td>{(++key+'.')}</td>
                    <td>{item.name}</td>
                    <td>{item.price}</td>
                    <td>{item.category}</td>
                    <td>{item.currentStock}</td>
                    <td>{item.createdAt}</td>
                    <td>
                        <a href={ '/items/'+item.id } className="btn btn-primary">View</a>
                    </td>
                </tr>
            );
        })
    }

    render() {
        return (
            <div>
                <h3>All Items{this.state.category?' for '+this.state.category.name:''}</h3>
                <div className="container-fluid">
                    <div className="table-responsivel">
                        <table className="table">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Name</th>
                                    <th>Price</th>
                                    <th>Category</th>
                                    <th>Stock</th>
                                    <th>CreatedAt</th>
                                    <th>Actions</th>
                                 {/*   <th>UpdatedAt</th>*/}
                                </tr>
                            </thead>
                            <tbody>
                                {this.renderItems()}
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        );
    }
}

export default CategoryItems;