import React, {Component} from 'react';

export default class SearchComponent extends Component {
    constructor(props) {
        super(props);

        this.state = {
            name: "",
            showWeather: false,
        };

        this.handleChange = this.handleChange.bind(this);
        this.handleCitySearch = this.handleCitySearch.bind(this);
    }

    handleChange(event) {
        this.setState({
            [event.target.name]: event.target.value
        });
    }

    handleCitySearch(event) {
        event.preventDefault();

        console.log('handluje!');
        this.setState({ showWeather: true});
        this.props.callbackFromParent(this.state);
    }

    render() {
        return (
            <div className={'d-flex search-component'}>
                <div className={"col item-center justify-content-center"}>
                    <label>{this.props.data.title}</label>
                    <input
                        type={"text"}
                        name={"name"}
                        list={"drivers"}
                        value={this.state.value}
                        placeholder={"np. London"}
                        onChange={this.handleChange}
                    />
                </div>
                <div className={"col text-center justify-content-center customize-button item-center"}>
                    <button
                        type={"button"}
                        className={"btn btn-primary"}
                        onClick={this.handleCitySearch}
                    >{this.props.data.button}</button>
                </div>
            </div>
        );
    }
}
