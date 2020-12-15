import React, {Component} from 'react';
import LineChart from "../../../Core/Chart/Line/LineChart.module";

export default class PressureWeatherComponent extends Component {
    constructor(props) {
        super(props);

        this.state = {
            data: {
                labels: [],
                datasets: [{
                    label: 'Dataset #1',
                    data: [],
                    backgroundColor: '#a4dbca'
                }]
            },
            title: 'Pressure',
            response: null,
            parsedResponse: false,
        }
    }

    async parseDataFromResponse() {
        if (this.props.data.response !== null && this.state.parsedResponse === false) {
            await this.setState({
                data: {
                    labels: [this.props.data.response.map((element) => {
                        return element.date
                    })],
                    datasets: [{
                        label: 'Dataset #1',
                        data: [this.props.data.response.map((element) => {
                            return element['value'] = element.pressure;
                        })],
                        backgroundColor: '#a4dbca'
                    }]
                },
                parsedResponse: true,
            });
        }
    }

    componentDidUpdate(prevProps, prevState) {
        this.parseDataFromResponse().then(r => {});
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
