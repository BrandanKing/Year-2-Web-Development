export const dataGraphs = {
	template:'#dataGraphs',
	name:'dataGraphs',
    data() {
        return {
            url: 'http://localhost/coursework/',
			doughnutData:[],
			barChartData:[],
			polarData:[],
			stackedData:{
				neverSmoked:[],
				currentSmoker:[],
				exSmoker:[],
			},
        }
    },
    async mounted() {
		await this.getChartData();
		this.generatDoughnutChart();
		this.generateBarChart();
		this.generatePolarChart();
		this.generateStackedChart();
    },
    methods: {
		// Get the chart data, use async and await to make sure the generate methods don't try and run before the data has been returned
		async getChartData(){
            var v = this;
            await axios.get(this.url + "chartdata/userStatus").then(function(response) {
                if (response.data.status != null) {
					v.doughnutData = response.data.status;
				}
            });
            await axios.get(this.url + "chartdata/averageMinsPerSession").then(function(response) {
                if (response.data.exercise != null) {
					v.barChartData = response.data.exercise;
				}
            });
            await axios.get(this.url + "chartdata/averageAlcoholScore").then(function(response) {
                if (response.data.score != null) {
					v.polarData = response.data.score;
				}
            });
            await axios.get(this.url + "chartdata/numberOfSmokers").then(function(response) {
                if (response.data.neversmoked != null) {
					v.stackedData.neverSmoked = response.data.neversmoked;
				}
                if (response.data.currentsmoker != null) {
					v.stackedData.currentSmoker = response.data.currentsmoker;
				}
                if (response.data.exsmoker != null) {
					v.stackedData.exSmoker = response.data.exsmoker;
				}
            });
		},
		generateBarChart(){
			var ctx = document.getElementById('barChart');
			var labels = [];
			var data = [];
			this.barChartData.forEach(function(element, index){
				labels[index] = element.exercise_days + ' Day' + (index == 0 ? '' : 's');;
				data[index] = element.average_minutes_session;
			});
			var data = {
				labels: labels,
				datasets: [{
					label: "Average Minutes",
					backgroundColor:"rgba(157,170,242,0.7)",
					hoverBackgroundColor:"rgba(157,170,242,1)",
					data: data,
				}]
			};
			
			var options = {
				maintainAspectRatio: false,
				responsive: true,
				title: {
					display: true,
					text: 'Average exercise session length based on number of days someone exercises'
				},
				onResize: function(chart, size) {
					chart.update();
				},
				scales: {
					yAxes: [{
						stacked: true,
						gridLines: {
							display: true,
							color: "rgba(255,99,132,0.2)"
						}
					}],
					xAxes: [{
						gridLines: {
							display: false
						}
					}]
				}
			};
			  
			new Chart(ctx, {
				type: 'bar',
				options: options,
				data: data
			});	
		},
		generatDoughnutChart(){
			var ctx = document.getElementById('doughnutChart');
			var labels = [];
			var data = [];
			this.doughnutData.forEach(function(element, index){
				labels[index] = (element.status ? element.status : 'incomplete');
				data[index] = element.users;
			});
			var data = {
				labels: labels,
				datasets: [{
					
					backgroundColor: [
						"rgba(55,65,81,0.7)",
						"rgba(52,211,153,0.7)",
						"rgba(239,215,86,0.7)",
						"rgba(244,98,72,0.7)",
					],
					hoverBackgroundColor:[
						"rgba(55,65,81,1)",
						"rgba(52,211,153,1)",
						"rgba(239,215,86,1)",
						"rgba(244,98,72,1)",
					],
					data: data,
				}]
			};
			  
			var options = {
				responsive: true,
				maintainAspectRatio: false,
				title: {
					display: true,
					text: "Status of patients questionnaires",
				},
				onResize: function(chart, size) {
					chart.update();
				},
				scales: {
					yAxes: [{
					stacked: true,
						gridLines: {
							display: true,
							color: "rgba(255,99,132,0.2)"
						}
					}],
					xAxes: [{
						gridLines: {
							display: false
						}
					}]
				}
			};
			  
			new Chart(ctx, {
				type: 'doughnut',
				options: options,
				data: data
			});	
		},
		generatePolarChart(){
			var ctx = document.getElementById('polarChart');
			var labels = [];
			var data = [];
			this.polarData.forEach(function(element, index){
				labels[index] = 'Question' + (index+1);
				data[index] = element.average_response_score;
			});
			var data = {
				labels: labels,
				datasets: [{
					
					backgroundColor: [
						"rgba(230, 25, 75,0.7)", 
						"rgba(60, 180, 75,0.7)",
						"rgba(255, 225, 25,0.7)",
						"rgba(0, 130, 200,0.7)",
						"rgba(245, 130, 48,0.7)",
						"rgba(145, 30, 180,0.7)",
						"rgba(70, 240, 240,0.7)",
						"rgba(240, 50, 230,0.7)",
						"rgba(210, 245, 60,0.7)",
						"rgba(250, 190, 212,0.7)",
						"rgba(0, 128, 128,0.7)"
					],
					hoverBackgroundColor:[
						"rgba(230, 25, 75,1)", 
						"rgba(60, 180, 75,1)",
						"rgba(255, 225, 25,1)",
						"rgba(0, 130, 200,1)",
						"rgba(245, 130, 48,1)",
						"rgba(145, 30, 180,1)",
						"rgba(70, 240, 240,1)",
						"rgba(240, 50, 230,1)",
						"rgba(210, 245, 60,1)",
						"rgba(250, 190, 212,1)",
						"rgba(0, 128, 128,1)"
					],
					data: data,
				}]
			};
			  
			var options = {
				maintainAspectRatio: false,
				responsive: true,
				title: {
					display: true,
					text: "Average alcohol score",
				},
				onResize: function(chart, size) {
					chart.update();
				},
				scales: {
					yAxes: [{
					stacked: true,
						gridLines: {
							display: true,
							color: "rgba(255,99,132,0.2)"
						}
					}],
					xAxes: [{
						gridLines: {
							display: false
						}
					}]
				}
			};
			  
			new Chart(ctx, {
				type: 'polarArea',
				options: options,
				data: data
			});	
		},
		generateStackedChart(){
			var ctx = document.getElementById('stackedChart');
			var dataNeverSmoked = [];
			var dataCurrentSmoker = [];
			var dataExSmoker = [];
			var months = [ 'January','February','March','April','May','June','July','August','September','October','November','December'];
			var v = this;
			months.forEach(function(element, index){
				dataNeverSmoked[index] = v.generateStackedData(element, v.stackedData.neverSmoked);
				dataExSmoker[index] = v.generateStackedData(element, v.stackedData.exSmoker);
				dataCurrentSmoker[index] = v.generateStackedData(element, v.stackedData.currentSmoker);
			});
			var data = {
				labels: months,
				datasets: [
					{
						label: 'Never Smoked',
						data: dataNeverSmoked,
						fill: true,
						backgroundColor: 'rgba(52,211,153,0.7)',
					},
					{
						label: 'Ex-Smoker',
						data: dataExSmoker,
						backgroundColor: 'rgba(244,98,72,0.7)',
					},
					{
						label: 'Current Smoker',
						data: dataCurrentSmoker,
						backgroundColor: 'rgba(239,215,86,0.7)',  
					}
				]
			};
			  
			var options = {
				maintainAspectRatio: false,
				onResize: function(chart, size) {
					chart.update();
				},
				plugins: {
					title: {
						display: true,
						text: 'Number of people in each smoking status based on the month they where born'
					},
					tooltip: {
						mode: 'index',
						intersect: false
					},
				},
				responsive: true,
			};
			  
			new Chart(ctx, {
				type: 'horizontalBar',
				data: data,
				options: options
			})	
		},
		// Get number of smokers per month or return 0
		generateStackedData(month, smokerType){
			for(var i = 0; i<smokerType.length; i++){
				if(month == smokerType[i].month){
					return smokerType[i].number_people
				}
			}
			return 0
		},
    }
};