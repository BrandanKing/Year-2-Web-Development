<template id="dataGraphs">
	<div class="grid xl:grid-cols-2 gap-4 overflow-hidden">
		<div class="bg-white dark:bg-blackalt rounded-2xl shadow-xl w-full h-fit-content px-6 py-8 overflow-hidden">
			<div class="chart-container ">
				<canvas id="barChart"></canvas>
			</div>
		</div>
		<div class="bg-white dark:bg-blackalt rounded-2xl shadow-xl w-full h-fit-content px-6 py-8 overflow-hidden">
			<div class="chart-container ">
				<canvas id="doughnutChart"></canvas>
			</div>
		</div>
		<div class="bg-white dark:bg-blackalt rounded-2xl shadow-xl w-full h-fit-content px-6 py-8 overflow-hidden">
			<div class="chart-container ">
				<canvas id="polarChart"></canvas>
			</div>
		</div>
		<div class="bg-white dark:bg-blackalt rounded-2xl shadow-xl w-full h-fit-content px-6 py-8 overflow-hidden">
			<div class="chart-container ">
				<canvas id="stackedChart"></canvas>
			</div>
		</div>
	</div>
</template>