import React, { Component } from 'react';
import axios from 'axios';

class CategoryList extends Component {

    constructor(props) {
        super(props);

        this.state = {
            categories: [],
            selectedCategory : null,
        };

        this.handleSelect = this.handleSelect.bind(this)
        this.isSelectedCategory = this.isSelectedCategory.bind(this)
    }

    componentWillMount() {
        this.setState({categories: this.props.categories})
    }

    isSelectedCategory(category)
    {
        if(this.state.selectedCategory === null)
            return ''
        else if(category.id === this.state.selectedCategory.id)
            return 'active'
        else
            return ''
    }

    handleSelect(category){
        this.props.onSelect(category)
        this.setState({ selectedCategory : category});
    }

    renderCategories() {
        return this.props.categories.map(category => {
            return (
                <li key={category.id} className={ "list-group-item "+this.isSelectedCategory(category) } onClick={(e)=>this.handleSelect(category,e)}>
                    { category.name }
                </li>
            );
        })
    }

    render() {
        return (
            <ul className="list-group">
                { this.renderCategories() }
            </ul>
        );
    }
}

export default CategoryList;