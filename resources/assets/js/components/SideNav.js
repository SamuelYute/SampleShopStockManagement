import React, {Component} from 'react'
import CategoryList from "./CategoryList";
import AddCategory from "./AddCategory";


    class SideNav extends Component
    {
        constructor(props)
        {
            super(props);

            this.state = {
                categories: [],
                endPoint : '/api/categories'
            };

            this.handleAdd = this.handleAdd.bind(this);
            this.handleCategorySelect = this.handleCategorySelect.bind(this);
            this.getCategories = this.getCategories.bind(this);
        }

        componentWillMount() {
            this.getCategories();
        }

        getCategories()
        {
            axios.get(this.state.endPoint)
                .then(({data})=>{
                    this.setState({categories: data.data});
                })
                .catch((res)=>{
                    console.log(res)
                });
        }

        handleAdd(category)
        {
            console.log()
            this.getCategories();
        }

        handleCategorySelect(category)
        {
            this.props.onCategorySelect(category);
        }

        render() {
            return (
                <div>
                    <h3>Categories</h3>
                    <div>
                        <AddCategory onAdd={this.handleAdd}/>
                    </div>

                    <div style={{marginTop: "20px", padding: "10px"}}>
                        <CategoryList onSelect={this.handleCategorySelect} categories={this.state.categories} />
                    </div>
                </div>
            );
        }
    }

export default SideNav;