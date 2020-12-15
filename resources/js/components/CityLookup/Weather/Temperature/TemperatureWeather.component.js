import React, {Component} from 'react';
import LineChart from "../../../Core/Chart/Line/LineChart.module";

export default class TemperatureWeatherComponent extends Component {
    constructor(props) {
        super(props);

        this.state = {
            city: "",
            data: {
                labels: [],
                datasets: [{
                    label: 'Dataset #1',
                    data: [],
                    backgroundColor: '#a4dbca'
                }]
            },
            title: 'Temperature',
            response: null,
            parsedResponse: false,
        }
    }

    async parseDataFromResponse() {
        await this.setState({
            city: this.props.data.city,
            data: {
                labels: [this.props.data.response.map((element) => {
                    return element.date
                })],
                datasets: [{
                    label: 'Dataset #1',
                    data: [this.props.data.response.map((element) => {
                        return element['value'] = element.temp;
                    })],
                    backgroundColor: '#a4dbca'
                }]
            },
            parsedResponse: true,
        });
    }

    componentDidUpdate(prevProps, prevState) {
        if (this.props.data.city !== prevProps.data.city) {
            this.parseDataFromResponse().then(r => {});
        }
    }

    render() {
        return(
            <div className={'component-weather-item'}>
                <LineChart
                    data={this.state.data}
                    title={this.state.title}
                    color="#70CAD1"
                />
            </div>
        );
    }
}
