import React, {Component} from 'react';
import {HeadersEnum} from "../Core/Text/Enum/Headers.enum.ts";
import {ButtonEnum} from "../Core/Text/Enum/Button.enum.ts";
import SearchComponent from "../Core/Search.component";

export default class CityLookupComponent extends Component {
    constructor(props) {
        super(props);

        this.state = {
            title: HeadersEnum.CITY_SEARCH,
            button: ButtonEnum.SEARCH,
            name: "",
            showWeather: false,
        };
    }

    citySearchCallback = (dataFromChild) => {
        this.setState({
            name: dataFromChild.name,
            showWeather: dataFromChild.showWeather
        });
    };

    render() {
        return(
            <div className={'city-lookup'}>
                <SearchComponent data={this.state} callbackFromParent={this.citySearchCallback} />
            </div>
        );
    }
}
