import React, { Component } from 'react'
import Chart from "chart.js";

export default class LineChart extends Component {
    constructor(props) {
        super(props);

        this.chartRef = React.createRef();
    }

    componentDidUpdate() {
        if (this.props.data.labels.length > 0) {
            this.myChart.data.labels = this.props.data.labels[0].map(d => d);
            this.myChart.data.datasets[0].data = this.props.data.datasets[0].data[0].map(d => d);
            this.myChart.update();
        }
    }

    componentDidMount() {
        this.myChart = new Chart(this.chartRef.current, {
            type: 'line',
            options: {
                scales: {
                    yAxes: [{
                        stacked: true
                    }]
                }
            },
            data: {
                labels: this.props.data.labels.map(d => d),
                datasets: [{
                    label: this.props.title,
                    data: this.props.data.datasets[0].data.map(d => d),
                    fill: 'none',
                    backgroundColor: this.props.color,
                    pointRadius: 2,
                    borderColor: this.props.color,
                    borderWidth: 1,
                    lineTension: 0
                }]
            }
        });
    }

    render() {
        return (
            <div className="chart-container">
                <canvas id={"chart"} ref={this.chartRef} />
            </div>
        );
    }
}
