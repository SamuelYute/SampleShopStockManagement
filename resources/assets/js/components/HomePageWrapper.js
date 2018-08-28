import React, {Component} from 'react'
import SideNav from "./SideNav";
import CategoryItems from "./CategoryItems";


class HomePageWrapper extends Component
{
    constructor(props)
    {
        super(props);

        this.state = {
            category: {
                id : '',
                name: ''
            },
        };

        this.handleCategorySelect = this.handleCategorySelect.bind(this);
    }

    handleCategorySelect(category)
    {
        this.setState({ category : { id : category.id, name : category.name}});
    }

    render() {
        return (
            <div className="row" style={{marginTop:"30px",paddingTop:"30px"}}>
                <div className="container-fluid">
                    <div className="col-md-3" style={{backgroundColor: "white"}}>
                        <SideNav onCategorySelect={this.handleCategorySelect} />
                    </div>

                    <div className="col-md-8 col-md-offset-1" style={{backgroundColor: "white"}}>
                        <CategoryItems category={this.state.category}/>
                    </div>
                </div>
            </div>
        );
    }
}

export default HomePageWrapper;