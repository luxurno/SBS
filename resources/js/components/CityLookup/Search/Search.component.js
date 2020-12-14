import React, {Component} from 'react';
import SearchDatalist from "./Datalist/Search.datalist";
import {CitiesStorageService} from "../../Core/Service/CitiesStorage.service.ts";

export default class SearchComponent extends Component {
    citiesStorageService$ = new CitiesStorageService();

    constructor(props) {
        super(props);

        this.state = {
            city: "",
            showWeather: false,
            disableButton: true,
        };
    }

    handleChange = async function(event, citiesStorageService$) {
        await this.setState({
            [event.target.name]: event.target.value,
            disableButton: !citiesStorageService$.getCities().includes(event.target.value)
        });
    }

    handleCitySearch = async function(event) {
        await this.setState({ showWeather: true });
        this.props.callbackFromParent(this.state);
    }

    render() {
        return (
            <div className={'d-flex component-search'}>
                <div className={"col item-center justify-content-center"}>
                    <label>{this.props.data.title}</label>
                    <input
                        type={"text"}
                        name={"city"}
                        list={"cities"}
                        value={this.state.value}
                        placeholder={"np. London"}
                        autoComplete={"off"}
                        onChange={(e) => {this.handleChange(e, this.citiesStorageService$)}}
                    />
                    <SearchDatalist />
                </div>
                <div className={"col text-center justify-content-center customize-button item-center"}>
                    <button
                        type={"button"}
                        className={"btn"}
                        disabled={this.state.disableButton}
                        onClick={(e) => {this.handleCitySearch(e)}}
                    >{this.props.data.button}</button>
                </div>
            </div>
        );
    }
}
