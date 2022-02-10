<template id="welcomeMessage">
    <div class="bg-brand dark:bg-blackalt rounded-2xl shadow-xl w-full h-fit-content px-6 py-8">
        <h2 class="font-montserrat font-bold lg:text-4xl text-2xl text-white mb-4">Welcome, <span class="text-tomato-500"><?= $this->session->userdata('username'); ?></span></h2>
        <?php if ($this->session->userdata('isAdmin')) : ?>
            <p class="font-montserrat font-normal text-lg text-white">This is the J&S Medical Practice dashboard. Inside this dashboard, you can complete a variety of tasks, such as accepting and refusing patient forms, reviewing the outcomes of patient forms with the aid of informative graphs and other useful features.</p>
        <?php else : ?>
            <p class="font-montserrat font-normal text-lg text-white">This is the J&S Medical Practice dashboard, please navigate to your form to check it's latest status.</p>
        <?php endif; ?>
    </div>
</template>