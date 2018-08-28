import React, { Component } from 'react';
import axios from 'axios';

class AddCategory extends Component {

    constructor(props) {
        super(props);

        this.state = {
            category: null,
            newCategory: {
                name: ''
            },
            endPoint : '/api/categories'
        };

        this.handleSubmit = this.handleSubmit.bind(this);
        this.handleInput = this.handleInput.bind(this);
    }

    handleInput(e) {
        this.setState({newCategory: {name : e.target.value}});
    }

    handleSubmit(e)
    {
        e.preventDefault();

        axios.post(this.state.endPoint,this.state.newCategory)
            .then(({data})=>{
                this.setState({category: data.data});
                this.props.onAdd(this.state.category)
            })
            .catch((res)=>{
                console.log(res)
            });
        this.setState({newCategory : {name:''}})
    }

    render() {
        return (
            <div style={{paddingRight:"10px"}}>
                <h4 style={{margin: '10px'}}>Add Category</h4>
                <form onSubmit={this.handleSubmit}>
                    <label id="new-category">Name</label>
                    <input id="new-category" onChange={(e)=>this.handleInput(e)} type="text" name="name" value={this.state.newCategory.name} className="form-control" style={{margin: '10px'}} required/>
                    <button className="btn btn-default" type="submit" >Add</button>
                    </form>
            </div>
        );
    }
}

export default AddCategory;