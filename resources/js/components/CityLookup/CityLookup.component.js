import React, {Component} from 'react';
import {HeadersEnum} from "../Core/Text/Enum/Headers.enum.ts";
import {ButtonEnum} from "../Core/Text/Enum/Button.enum.ts";
import SearchComponent from "./Search/Search.component";
import WeatherComponent from "./Weather/Weather.component";

export default class CityLookupComponent extends Component {
    constructor(props) {
        super(props);

        this.state = {
            title: HeadersEnum.CITY_SEARCH,
            button: ButtonEnum.SEARCH,
            city: "",
            showWeather: false
        };
    }

    callbackCitySearch = async (dataFromChild) => {
        await this.setState({
            city: dataFromChild.city,
            showWeather: dataFromChild.showWeather,
        });
    };

    render() {
        return(
            <div className={'row justify-content-center component-city-lookup'}>
                <SearchComponent data={this.state} callbackFromParent={this.callbackCitySearch} />
                <WeatherComponent data={this.state} />
            </div>
        );
    }
}
