<div v-else class="mx-auto relative">
    <h6 class="font-montserrat font-bold sm:text-lg text-md text-brand dark:text-white md:mb-4 cursor-pointer" @click="updateForm = false; clearAll()">
        <svg width="20" height="20" class="inline-block">
            <use xlink:href="#arrow-left"></use>
        </svg>
        Back
    </h6>

    <?php if ($this->session->userdata('isAdmin')) : ?>
        <ul class="list-none md:absolute md:top-0 md:right-0">
            <li v-if="chooseUser.status" class="inline-block cursor-pointer  my-2 transform hover:scale-105 motion-reduce:transform-none focus:outline-none bg-green-400 transition duration-150 text-white ease-in-out rounded px-4 sm:px-8 py-2 text-xs sm:text-sm font-bold" @click="alterStatus(chooseUser, 'approved'); updateForm = false; clearAll()">Approve</li>
            <li v-if="chooseUser.status" class="inline-block cursor-pointer  my-2 transform hover:scale-105 motion-reduce:transform-none focus:outline-none bg-tomato-500 transition duration-150 text-white ease-in-out rounded px-4 sm:px-8 py-2 text-xs sm:text-sm font-bold" @click="alterStatus(chooseUser, 'rejected'); updateForm = false; clearAll()">Reject</li>
        </ul>
    <?php endif; ?>
    <h2 class="font-montserrat font-bold text-2xl text-brand dark:text-white mb-4">New Patient Questionnaire</h2>
    <p class="font-montserrat font-normal sm:text-lg text-md text-brand dark:text-white">In order to register as a new patient at the Practice you need to complete this form. Please complete all of the relevant questions to the best of your ability. Thank you!</p>

    <div class="w-full my-4">

        <!-- Form Completition -->
        <div class="relative pt-1" v-if="chooseUser.GUID == <?= $this->session->userdata('userID'); ?>">
            <div class="flex mb-2 items-center justify-between">
                <div>
                    <span class="text-xs font-semibold inline-block py-1 px-2 uppercase rounded-full  text-tomato-500 bg-tomato-200">
                        Form completion
                    </span>
                </div>
                <div class="text-right">
                    <span class="text-xs font-semibold inline-block text-tomato-500">
                        {{(currentStep/maxSteps) * 100}}%
                    </span>
                </div>
            </div>
            <div class="overflow-hidden h-2 mb-4 text-xs flex rounded bg-tomato-200">
                <div :style="{ width: (currentStep/maxSteps) * 100 + '%' }" class="shadow-none flex flex-col text-center whitespace-nowrap text-white justify-center bg-tomato-500"></div>
            </div>
        </div>

        <!-- Step 1 start -->
        <div class="flex flex-wrap" v-show="currentStep == 1">

            <!-- Your Details start -->
            <p class="w-full font-montserrat font-bold sm:text-lg text-md text-brand dark:text-white mb-3 flex flex-col">Your Details</p>
            <div class="sm:w-1/5 w-full mb-3 flex flex-col sm:px-2">
                <label for="title" class="pb-2 text-sm font-bold text-brand dark:text-white">Title*</label>
                <input v-model="chooseUser.title" :class="{' border-red-400': formValidate.title}" type="text" placeholder="Title*" name="title" class="border shadow-sm rounded text-sm focus:outline-none focus:shadow-none text-brand focus:ring-transparent">
                <div class="flex justify-between items-center pt-1 text-red-400" v-if="formValidate.title">
                    <p class="text-xs" v-html="formValidate.title"></p>
                    <svg width="16" height="16">
                        <use xlink:href="#rejected"></use>
                    </svg>
                </div>
            </div>
            <div class="sm:w-2/5 w-full mb-3 flex flex-col sm:px-2">
                <label for="firstname" class="pb-2 text-sm font-bold text-brand dark:text-white">First Name*</label>
                <input v-model="chooseUser.firstname" :class="{' border-red-400': formValidate.firstname}" type="text" placeholder="First Name*" name="firstname" class="border shadow-sm rounded text-sm focus:outline-none focus:shadow-none text-brand focus:ring-transparent">
                <div class="flex justify-between items-center pt-1 text-red-400" v-if="formValidate.firstname">
                    <p class="text-xs" v-html="formValidate.firstname"></p>
                    <svg width="16" height="16">
                        <use xlink:href="#rejected"></use>
                    </svg>
                </div>
            </div>
            <div class="sm:w-2/5 w-full mb-3 flex flex-col sm:px-2">
                <label for="surname" class="pb-2 text-sm font-bold text-brand dark:text-white">Surname*</label>
                <input v-model="chooseUser.surname" :class="{' border-red-400': formValidate.surname}" type="text" placeholder="Surname*" name="surname" class="border shadow-sm rounded text-sm focus:outline-none focus:shadow-none text-brand focus:ring-transparent">
                <div class="flex justify-between items-center pt-1 text-red-400" v-if="formValidate.surname">
                    <p class="text-xs" v-html="formValidate.surname"></p>
                    <svg width="16" height="16">
                        <use xlink:href="#rejected"></use>
                    </svg>
                </div>
            </div>

            <div class="sm:w-1/3 w-full mb-3 flex flex-col sm:px-2">
                <label for="dob" class="pb-2 text-sm font-bold text-brand dark:text-white">Date of Birth*</label>
                <input v-model="chooseUser.dob" :class="{' border-red-400': formValidate.dob}" type="Date" placeholder="Date of Birth*" name="dob" class="border shadow-sm rounded text-sm focus:outline-none focus:shadow-none text-brand focus:ring-transparent" max="<?= date('Y-m-d'); ?>">
                <div class="flex justify-between items-center pt-1 text-red-400" v-if="formValidate.dob">
                    <p class="text-xs" v-html="formValidate.dob"></p>
                    <svg width="16" height="16">
                        <use xlink:href="#rejected"></use>
                    </svg>
                </div>
            </div>
            <div class="sm:w-1/3 w-full mb-3 flex flex-col sm:px-2">
                <label for="gender" class="pb-2 text-sm font-bold text-brand dark:text-white">Gender*</label>
                <input v-model="chooseUser.gender" :class="{' border-red-400': formValidate.gender}" type="text" placeholder="Gender*" name="gender" class="border shadow-sm rounded text-sm focus:outline-none focus:shadow-none text-brand focus:ring-transparent" list="gender">
                <datalist id="gender">
                    <option>Male</option>
                    <option>Female</option>
                    <option>Other</option>
                </datalist>
                <div class="flex justify-between items-center pt-1 text-red-400" v-if="formValidate.gender">
                    <p class="text-xs" v-html="formValidate.gender"></p>
                    <svg width="16" height="16">
                        <use xlink:href="#rejected"></use>
                    </svg>
                </div>
            </div>
            <div class="sm:w-1/3 w-full mb-3 flex flex-col sm:px-2">
                <label for="maritalstatus" class="pb-2 text-sm font-bold text-brand dark:text-white">Marital Status*</label>
                <select v-model="chooseUser.marital_status" :class="{' border-red-400': formValidate.marital_status}" name="maritalstatus" class="border shadow-sm rounded text-sm focus:outline-none focus:shadow-none text-brand focus:ring-transparent">
                    <option value="" disabled>Marital Status*</option>
                    <option value="Single">Single</option>
                    <option value="Married">Married</option>
                    <option value="Divorced">Divorced</option>
                    <option value="Civil Partnership">Civil Partnership</option>
                    <option value="Other">Other</option>
                </select>
                <div class="flex justify-between items-center pt-1 text-red-400" v-if="formValidate.marital_status">
                    <p class="text-xs" v-html="formValidate.marital_status"></p>
                    <svg width="16" height="16">
                        <use xlink:href="#rejected"></use>
                    </svg>
                </div>
            </div>

            <div class="sm:w-2/3 w-full mb-3 flex flex-col sm:px-2">
                <label for="address" class="pb-2 text-sm font-bold text-brand dark:text-white">Address*</label>
                <input v-model="chooseUser.address" :class="{' border-red-400': formValidate.address}" type="text" placeholder="Address*" name="address" class="border shadow-sm rounded text-sm focus:outline-none focus:shadow-none text-brand focus:ring-transparent">
                <div class="flex justify-between items-center pt-1 text-red-400" v-if="formValidate.address">
                    <p class="text-xs" v-html="formValidate.address"></p>
                    <svg width="16" height="16">
                        <use xlink:href="#rejected"></use>
                    </svg>
                </div>
            </div>
            <div class="sm:w-1/3 w-full mb-3 flex flex-col sm:px-2">
                <label for="postcode" class="pb-2 text-sm font-bold text-brand dark:text-white">Post Code*</label>
                <input v-model="chooseUser.postcode" :class="{' border-red-400': formValidate.postcode}" type="text" placeholder="Post Code*" name="postcode" class="border shadow-sm rounded text-sm focus:outline-none focus:shadow-none text-brand focus:ring-transparent">
                <div class="flex justify-between items-center pt-1 text-red-400" v-if="formValidate.postcode">
                    <p class="text-xs" v-html="formValidate.postcode"></p>
                    <svg width="16" height="16">
                        <use xlink:href="#rejected"></use>
                    </svg>
                </div>
            </div>

            <div class="sm:w-1/3 w-full mb-3 flex flex-col sm:px-2">
                <label for="height" class="pb-2 text-sm font-bold text-brand dark:text-white">Height (ft)*</label>
                <input v-model="chooseUser.height" :class="{' border-red-400': formValidate.height}" type="number" placeholder="Height*" name="height" class="border shadow-sm rounded text-sm focus:outline-none focus:shadow-none text-brand focus:ring-transparent" step=".1" min="1.8" max="9">
                <div class="flex justify-between items-center pt-1 text-red-400" v-if="formValidate.height">
                    <p class="text-xs" v-html="formValidate.height"></p>
                    <svg width="16" height="16">
                        <use xlink:href="#rejected"></use>
                    </svg>
                </div>
            </div>
            <div class="sm:w-1/3 w-full mb-3 flex flex-col sm:px-2">
                <label for="weight" class="pb-2 text-sm font-bold text-brand dark:text-white">Weight (st)*</label>
                <input v-model="chooseUser.weight" :class="{' border-red-400': formValidate.weight}" type="number" placeholder="Weight*" name="weight" class="border shadow-sm rounded text-sm focus:outline-none focus:shadow-none text-brand focus:ring-transparent" min="3" max="99">
                <div class="flex justify-between items-center pt-1 text-red-400" v-if="formValidate.weight">
                    <p class="text-xs" v-html="formValidate.weight"></p>
                    <svg width="16" height="16">
                        <use xlink:href="#rejected"></use>
                    </svg>
                </div>
            </div>
            <div class="sm:w-1/3 w-full mb-3 flex flex-col sm:px-2">
                <label for="occupation" class="pb-2 text-sm font-bold text-brand dark:text-white">Occupation</label>
                <input v-model="chooseUser.occupation" type="text" placeholder="Occupation" name="occupation" class="border shadow-sm rounded text-sm focus:outline-none focus:shadow-none text-brand focus:ring-transparent">
            </div>

            <div class="sm:w-1/3 w-full mb-3 flex flex-col sm:px-2">
                <label for="email" class="pb-2 text-sm font-bold text-brand dark:text-white">Email*</label>
                <input v-model="chooseUser.email" :class="{' border-red-400': formValidate.email}" type="email" placeholder="Email*" name="email" class="border shadow-sm rounded text-sm focus:outline-none focus:shadow-none text-brand focus:ring-transparent">
                <div class="flex justify-between items-center pt-1 text-red-400" v-if="formValidate.email">
                    <p class="text-xs" v-html="formValidate.email"></p>
                    <svg width="16" height="16">
                        <use xlink:href="#rejected"></use>
                    </svg>
                </div>
            </div>
            <div class="sm:w-1/3 w-full mb-3 flex flex-col sm:px-2">
                <label for="mobile" class="pb-2 text-sm font-bold text-brand dark:text-white">Mobile*</label>
                <input v-model="chooseUser.mobile" :class="{' border-red-400': formValidate.mobile}" type="tel" placeholder="Mobile*" name="mobile" class="border shadow-sm rounded text-sm focus:outline-none focus:shadow-none text-brand focus:ring-transparent">
                <div class="flex justify-between items-center pt-1 text-red-400" v-if="formValidate.mobile">
                    <p class="text-xs" v-html="formValidate.mobile"></p>
                    <svg width="16" height="16">
                        <use xlink:href="#rejected"></use>
                    </svg>
                </div>
            </div>
            <div class="sm:w-1/3 w-full mb-3 flex flex-col sm:px-2">
                <label for="telephone" class="pb-2 text-sm font-bold text-brand dark:text-white">Home Telephone</label>
                <input v-model="chooseUser.home_telephone" :class="{' border-red-400': formValidate.home_telephone}" type="tel" placeholder="Home Telephone" name="telephone" class="border shadow-sm rounded text-sm focus:outline-none focus:shadow-none text-brand focus:ring-transparent">
                <div class="flex justify-between items-center pt-1 text-red-400" v-if="formValidate.home_telephone">
                    <p class="text-xs" v-html="formValidate.home_telephone"></p>
                    <svg width="16" height="16">
                        <use xlink:href="#rejected"></use>
                    </svg>
                </div>
            </div>

            <div class="sm:w-1/2 w-full mb-3 flex flex-col sm:px-2">
                <p class="w-full text-xs text-brand dark:text-white">Please confirm if you would be happy to receive contact via SMS messages: {{chooseUser.SMS_YN}}</p>
                <div class="flex sm:flex-row flex-col mt-2">
                    <label class="inline-flex items-center mr-2">
                        <input v-model="chooseUser.SMS_YN" type="radio" name="sms-contact" class="text-brand dark:text-green-500" value="yes">
                        <span class="ml-2 text-xs text-brand dark:text-white mb-2">Yes</span>
                    </label>
                    <label class="inline-flex items-center">
                        <input v-model="chooseUser.SMS_YN" type="radio" name="sms-contact" class="text-brand dark:text-green-500" value="no">
                        <span class=" ml-2 text-xs text-brand dark:text-white mb-2">No</span>
                    </label>
                </div>
                <div class="flex justify-between items-center pt-1 text-red-400" v-if="formValidate.SMS_YN">
                    <p class="text-xs" v-html="formValidate.SMS_YN"></p>
                    <svg width="16" height="16">
                        <use xlink:href="#rejected"></use>
                    </svg>
                </div>
            </div>
            <div class="sm:w-1/2 w-full mb-3 flex flex-col sm:px-2">
                <p class="w-full text-xs text-brand dark:text-white">Please confirm if you would be happy to receive email communications from us:</p>
                <div class="flex sm:flex-row flex-col mt-2">
                    <label class="inline-flex items-center mr-2">
                        <input v-model="chooseUser.email_yn" type="radio" name="email-contact" class="text-brand dark:text-green-500" value="yes">
                        <span class="ml-2 text-xs text-brand dark:text-white mb-2">Yes</span>
                    </label>
                    <label class="inline-flex items-center">
                        <input v-model="chooseUser.email_yn" type="radio" name="email-contact" class="text-brand dark:text-green-500" value="no">
                        <span class="ml-2 text-xs text-brand dark:text-white mb-2">No</span>
                    </label>
                </div>
                <div class="flex justify-between items-center pt-1 text-red-400" v-if="formValidate.email_yn">
                    <p class="text-xs" v-html="formValidate.email_yn"></p>
                    <svg width="16" height="16">
                        <use xlink:href="#rejected"></use>
                    </svg>
                </div>
            </div>
            <!-- Your Details End -->

            <!-- Next of Kin start -->
            <p class="w-full font-montserrat font-bold sm:text-lg text-md text-brand dark:text-white mb-3 flex flex-col">Next of Kin</p>
            <div class="sm:w-1/3 w-full mb-3 flex flex-col sm:px-2">
                <label for="name" class="pb-2 text-sm font-bold text-brand dark:text-white">Name*</label>
                <input v-model="chooseUser.kin_name" :class="{' border-red-400': formValidate.kin_name}" type="text" placeholder="Name*" name="name" class="border shadow-sm rounded text-sm focus:outline-none focus:shadow-none text-brand focus:ring-transparent">
                <div class="flex justify-between items-center pt-1 text-red-400" v-if="formValidate.kin_name">
                    <p class="text-xs" v-html="formValidate.kin_name"></p>
                    <svg width="16" height="16">
                        <use xlink:href="#rejected"></use>
                    </svg>
                </div>
            </div>
            <div class="sm:w-1/3 w-full mb-3 flex flex-col sm:px-2">
                <label for="relationship" class="pb-2 text-sm font-bold text-brand dark:text-white">Relationship*</label>
                <input v-model="chooseUser.kin_relationship" :class="{' border-red-400': formValidate.kin_relationship}" type="text" placeholder="Relationship*" name="relationship" class="border shadow-sm rounded text-sm focus:outline-none focus:shadow-none text-brand focus:ring-transparent">
                <div class="flex justify-between items-center pt-1 text-red-400" v-if="formValidate.kin_relationship">
                    <p class="text-xs" v-html="formValidate.kin_relationship"></p>
                    <svg width="16" height="16">
                        <use xlink:href="#rejected"></use>
                    </svg>
                </div>
            </div>
            <div class="sm:w-1/3 w-full mb-3 flex flex-col sm:px-2">
                <label for="kin_telephone" class="pb-2 text-sm font-bold text-brand dark:text-white">Telephone*</label>
                <input v-model="chooseUser.kin_telephone" :class="{' border-red-400': formValidate.kin_telephone}" type="tel" placeholder="Telephone*" name="kin_telephone" class="border shadow-sm rounded text-sm focus:outline-none focus:shadow-none text-brand focus:ring-transparent">
                <div class="flex justify-between items-center pt-1 text-red-400" v-if="formValidate.kin_telephone">
                    <p class="text-xs" v-html="formValidate.kin_telephone"></p>
                    <svg width="16" height="16">
                        <use xlink:href="#rejected"></use>
                    </svg>
                </div>
            </div>
            <!-- Next of Kin End -->

        </div>
        <!-- Step 1 End -->

        <!-- Step 2 start -->
        <div class="flex flex-wrap" v-show="currentStep == 2">

            <!-- Medication Start -->
            <p class="w-full font-montserrat font-bold sm:text-lg text-md text-brand dark:text-white mb-3 flex flex-col">Medication*</p>
            <div class="w-full mb-3 flex flex-col sm:px-2">

                <div class="flex sm:flex-row flex-col mt-2">
                    <p class="mr-2 text-xs text-brand dark:text-white">Are you currently taking any medication?</p>
                    <label class="inline-flex items-center mr-2">
                        <input v-model="chooseUser.Medication_YN" type="radio" name="medication" class="text-brand dark:text-green-500" value="Yes">
                        <span class="ml-2 text-xs text-brand dark:text-white mb-2">Yes</span>
                    </label>
                    <label class="inline-flex items-center">
                        <input v-model="chooseUser.Medication_YN" type="radio" name="medication" class="text-brand dark:text-green-500" value="No">
                        <span class="ml-2 text-xs text-brand dark:text-white mb-2">No</span>
                    </label>
                </div>

                <div class="flex justify-between items-center pt-1 text-red-400" v-if="formValidate.Medication_YN">
                    <p class="text-xs" v-html="formValidate.Medication_YN"></p>
                    <svg width="16" height="16">
                        <use xlink:href="#rejected"></use>
                    </svg>
                </div>

            </div>
            <div class="w-full flex sm:flex-row flex-col" v-if="chooseUser.Medication_YN == 'Yes'">

                <div class="sm:w-1/3 w-full mb-3 flex flex-col sm:px-2">
                    <label for="medication1" class="pb-2 text-sm font-bold text-brand dark:text-white">Medication 1*</label>
                    <input v-model="chooseUser.Medication_1" :class="{' border-red-400': formValidate.Medication_1}" type="text" placeholder="Medication*" name="medication1" class="border shadow-sm rounded text-sm focus:outline-none focus:shadow-none text-brand focus:ring-transparent">
                    <div class="flex justify-between items-center pt-1 text-red-400" v-if="formValidate.Medication_1">
                        <p class="text-xs" v-html="formValidate.Medication_1"></p>
                        <svg width="16" height="16">
                            <use xlink:href="#rejected"></use>
                        </svg>
                    </div>
                </div>

                <div class="sm:w-1/3 w-full mb-3 flex flex-col sm:px-2">
                    <label for="medication_frequency_1" class="pb-2 text-sm font-bold text-brand dark:text-white">Medication Frequency 1*</label>
                    <input v-model="chooseUser.medication_frequency_1" :class="{' border-red-400': formValidate.medication_frequency_1}" type="text" placeholder="Medication Frequency*" name="medication_frequency_1" class="border shadow-sm rounded text-sm focus:outline-none focus:shadow-none text-brand focus:ring-transparent">
                    <div class="flex justify-between items-center pt-1 text-red-400" v-if="formValidate.medication_frequency_1">
                        <p class="text-xs" v-html="formValidate.medication_frequency_1"></p>
                        <svg width="16" height="16">
                            <use xlink:href="#rejected"></use>
                        </svg>
                    </div>
                </div>

                <div class="sm:w-1/3 w-full mb-3 flex flex-col sm:px-2">
                    <label for="medication_dosage_1" class="pb-2 text-sm font-bold text-brand dark:text-white">Medication Dosage 1*</label>
                    <input v-model="chooseUser.medication_dosage_1" :class="{' border-red-400': formValidate.medication_dosage_1}" type="text" placeholder="Medication Dosage*" name="medication_dosage_1" class="border shadow-sm rounded text-sm focus:outline-none focus:shadow-none text-brand focus:ring-transparent">
                    <div class="flex justify-between items-center pt-1 text-red-400" v-if="formValidate.medication_dosage_1">
                        <p class="text-xs" v-html="formValidate.medication_dosage_1"></p>
                        <svg width="16" height="16">
                            <use xlink:href="#rejected"></use>
                        </svg>
                    </div>
                </div>

            </div>
            <div class="w-full flex sm:flex-row flex-col" v-if="chooseUser.Medication_YN == 'Yes' && chooseUser.Medication_1">

                <div class="sm:w-1/3 w-full mb-3 flex flex-col sm:px-2">
                    <label for="medication2" class="pb-2 text-sm font-bold text-brand dark:text-white">Medication 2</label>
                    <input v-model="chooseUser.Medication_2" type="text" placeholder="Medication" name="medication2" class="border shadow-sm rounded text-sm focus:outline-none focus:shadow-none text-brand focus:ring-transparent">
                </div>

                <div class="sm:w-1/3 w-full mb-3 flex flex-col sm:px-2">
                    <label for="medication_frequency_2" class="pb-2 text-sm font-bold text-brand dark:text-white">Medication Frequency 2</label>
                    <input v-model="chooseUser.medication_frequency_2" type="text" placeholder="Medication Frequency" name="medication_frequency_2" class="border shadow-sm rounded text-sm focus:outline-none focus:shadow-none text-brand focus:ring-transparent">
                </div>

                <div class="sm:w-1/3 w-full mb-3 flex flex-col sm:px-2">
                    <label for="medication_dosage_2" class="pb-2 text-sm font-bold text-brand dark:text-white">Medication Dosage 2</label>
                    <input v-model="chooseUser.medication_dosage_2" type="text" placeholder="Medication Dosage" name="medication_dosage_2" class="border shadow-sm rounded text-sm focus:outline-none focus:shadow-none text-brand focus:ring-transparent">
                </div>

            </div>
            <div class="w-full flex sm:flex-row flex-col" v-if="chooseUser.Medication_YN == 'Yes' && chooseUser.Medication_2">

                <div class="sm:w-1/3 w-full mb-3 flex flex-col sm:px-2">
                    <label for="medication3" class="pb-2 text-sm font-bold text-brand dark:text-white">Medication 3</label>
                    <input v-model="chooseUser.Medication_3" type="text" placeholder="Medication" name="medication3" class="border shadow-sm rounded text-sm focus:outline-none focus:shadow-none text-brand focus:ring-transparent">
                </div>

                <div class="sm:w-1/3 w-full mb-3 flex flex-col sm:px-2">
                    <label for="medication_frequency_3" class="pb-2 text-sm font-bold text-brand dark:text-white">Medication Frequency 3</label>
                    <input v-model="chooseUser.medication_frequency_3" type="text" placeholder="Medication Frequency" name="medication_frequency_3" class="border shadow-sm rounded text-sm focus:outline-none focus:shadow-none text-brand focus:ring-transparent">
                </div>

                <div class="sm:w-1/3 w-full mb-3 flex flex-col sm:px-2">
                    <label for="medication_dosage_3" class="pb-2 text-sm font-bold text-brand dark:text-white">Medication Dosage 3</label>
                    <input v-model="chooseUser.medication_dosage_3" type="text" placeholder="Medication Dosage" name="medication_dosage_3" class="border shadow-sm rounded text-sm focus:outline-none focus:shadow-none text-brand focus:ring-transparent">
                </div>

            </div>
            <!-- Medication End -->

            <!-- Smoke Status start -->
            <p class="w-full font-montserrat font-bold sm:text-lg text-md text-brand dark:text-white mb-3 flex flex-col">Smoking Status*</p>
            <div class="w-full flex sm:flex-row flex-col">

                <div class="sm:w-1/3 w-full mb-3 flex flex-col sm:px-2">
                    <label for="smoke_status" class="pb-2 text-sm font-bold text-brand dark:text-white">Your current smoking status*</label>
                    <select v-model="chooseUser.smoke_status" :class="{' border-red-400': formValidate.smoke_status}" name="smoke_status" class="border shadow-sm rounded text-sm focus:outline-none focus:shadow-none text-brand focus:ring-transparent">
                        <option value="Never Smoked">Never Smoked</option>
                        <option value="Current Smoker">Current Smoker</option>
                        <option value="Ex-smoker">Ex-smoker</option>
                    </select>
                    <div class="flex justify-between items-center pt-1 text-red-400" v-if="formValidate.smoke_status">
                        <p class="text-xs" v-html="formValidate.smoke_status"></p>
                        <svg width="16" height="16">
                            <use xlink:href="#rejected"></use>
                        </svg>
                    </div>
                </div>

                <div class="sm:w-1/3 w-full mb-3 flex flex-col sm:px-2" v-if="chooseUser.smoke_status == 'Current Smoker'">
                    <label for="smoke_type" class="pb-2 text-sm font-bold text-brand dark:text-white">What do you smoke*</label>
                    <select v-model="chooseUser.smoke_type" :class="{' border-red-400': formValidate.smoke_type}" name="smoke_type" class="border shadow-sm rounded text-sm focus:outline-none focus:shadow-none text-brand focus:ring-transparent">
                        <option value="Cigarettes">Cigarettes</option>
                        <option value="Cigars">Cigars</option>
                        <option value="E-cigarettes">E-cigarettes</option>
                        <option value="Pipe">Pipe</option>
                    </select>
                    <div class="flex justify-between items-center pt-1 text-red-400" v-if="formValidate.smoke_type">
                        <p class="text-xs" v-html="formValidate.smoke_type"></p>
                        <svg width="16" height="16">
                            <use xlink:href="#rejected"></use>
                        </svg>
                    </div>
                </div>

                <div class="sm:w-1/3 w-full mb-3 flex flex-col sm:px-2" v-if="chooseUser.smoke_status == 'Current Smoker'">
                    <label for="start_smoking" class="pb-2 text-sm font-bold text-brand dark:text-white">Age when you started smoking*</label>
                    <input v-model="chooseUser.start_smoking" :class="{' border-red-400': formValidate.start_smoking}" min="10" type="number" name="start_smoking" class="border shadow-sm rounded text-sm focus:outline-none focus:shadow-none text-brand focus:ring-transparent">
                    <div class="flex justify-between items-center pt-1 text-red-400" v-if="formValidate.start_smoking">
                        <p class="text-xs" v-html="formValidate.start_smoking"></p>
                        <svg width="16" height="16">
                            <use xlink:href="#rejected"></use>
                        </svg>
                    </div>
                </div>

            </div>
            <div class="w-full mb-3 flex flex-col sm:px-2" v-if="chooseUser.smoke_status == 'Current Smoker'">

                <div class="flex sm:flex-row flex-col mt-2">
                    <p class="mr-2 text-xs text-brand dark:text-white">Do you want more information for support to help you quit smoking?</p>
                    <label class="inline-flex items-center mr-2">
                        <input v-model="chooseUser.quit_smoking" type="radio" name="quit_smoking" class="text-brand dark:text-green-500" value="Yes">
                        <span class="ml-2 text-xs text-brand dark:text-white mb-2">Yes</span>
                    </label>
                    <label class="inline-flex items-center">
                        <input v-model="chooseUser.quit_smoking" type="radio" name="quit_smoking" class="text-brand dark:text-green-500" value="No">
                        <span class="ml-2 text-xs text-brand dark:text-white mb-2">No</span>
                    </label>
                </div>

                <div class="flex justify-between items-center pt-1 text-red-400" v-if="formValidate.quit_smoking">
                    <p class="text-xs" v-html="formValidate.quit_smoking"></p>
                    <svg width="16" height="16">
                        <use xlink:href="#rejected"></use>
                    </svg>
                </div>

            </div>
            <!-- Smoke Status End -->

        </div>
        <!-- Step 2 End -->

        <!-- Step 3 start (Alcohol Questions) -->
        <div class="flex flex-wrap" v-show="currentStep == 3">
            <div class="w-full mb-3 flex flex-col sm:px-2" v-for="(question, index) in alcohol_questions">

                <p class="mr-2 text-md text-brand dark:text-white font-bold font-montserrat">{{question.Question}}</p>
                <div class="flex md:flex-row flex-col mt-2">
                    <label class="inline-flex items-center mr-3" v-if="question.response0">
                        <input type="radio" :name="'question'+index" class="text-brand dark:text-green-500" v-model="chooseUser['response'+index]" :value="question.response0" @change="chooseUser['response_score'+index] = 1">
                        <span class="ml-2 text-md text-brand dark:text-white">{{question.response0}}</span>
                    </label>
                    <label class="inline-flex items-center mr-3" v-if="question.response1">
                        <input type="radio" :name="'question'+index" class="text-brand dark:text-green-500" v-model="chooseUser['response'+index]" :value="question.response1" @change="chooseUser['response_score'+index] = 2">
                        <span class="ml-2 text-md text-brand dark:text-white">{{question.response1}}</span>
                    </label>
                    <label class="inline-flex items-center mr-3" v-if="question.response2">
                        <input type="radio" :name="'question'+index" class="text-brand dark:text-green-500" v-model="chooseUser['response'+index]" :value="question.response2" @change="chooseUser['response_score'+index] = 3">
                        <span class="ml-2 text-md text-brand dark:text-white">{{question.response2}}</span>
                    </label>
                    <label class="inline-flex items-center mr-3" v-if="question.response3">
                        <input type="radio" :name="'question'+index" class="text-brand dark:text-green-500" v-model="chooseUser['response'+index]" :value="question.response3" @change="chooseUser['response_score'+index] = 4">
                        <span class="ml-2 text-md text-brand dark:text-white">{{question.response3}}</span>
                    </label>
                    <label class="inline-flex items-center mr-3" v-if="question.response4">
                        <input type="radio" :name="'question'+index" class="text-brand dark:text-green-500" v-model="chooseUser['response'+index]" :value="question.response4" @change="chooseUser['response_score'+index] = 5">
                        <span class="ml-2 text-md text-brand dark:text-white">{{question.response4}}</span>
                    </label>
                </div>

                <div class="flex justify-between items-center pt-1 text-red-400" v-if="formValidate['response'+index]">
                    <p class="text-xs" v-html="formValidate['response'+index]"></p>
                    <svg width="16" height="16">
                        <use xlink:href="#rejected"></use>
                    </svg>
                </div>

            </div>
        </div>
        <!-- Step 3 End -->

        <!-- Step 4 start -->
        <div class="flex flex-wrap" v-show="currentStep == 4">

            <!-- Family Medical History Start -->
            <p class="w-full font-montserrat font-bold sm:text-lg text-md text-brand dark:text-white mb-3 flex flex-col">Family Medical History*</p>
            <p class="w-full font-montserrat font-base text-md text-brand dark:text-white mb-3 flex flex-col">Do any of your close family (grandparents, parents, brothers, sisters) suffer from or have had, any of the following?</p>
            <div class="w-full mb-3 flex flex-col">

                <p class="mr-2 text-md text-brand dark:text-white font-bold font-montserrat">Cancer</p>
                <div class="flex sm:flex-row flex-col mt-2">
                    <label class="inline-flex items-center mr-3">
                        <input type="radio" name="has_cancer" class="text-brand dark:text-green-500" value="Yes" @change="chooseUser.has_cancer = ''; chooseUser.cancerToggle = 'Yes'" :checked="chooseUser.has_cancer != 'No'">
                        <span class="ml-2 text-md text-brand dark:text-white">Yes</span>
                    </label>
                    <label class="inline-flex items-center mr-3">
                        <input type="radio" name="has_cancer" class="text-brand dark:text-green-500" value="No" v-model="chooseUser.has_cancer" @change="chooseUser.cancerToggle = ''">
                        <span class="ml-2 text-md text-brand dark:text-white">No</span>
                    </label>
                    <input v-if="chooseUser.cancerToggle || chooseUser.has_cancer != 'No'" v-model="chooseUser.has_cancer" :class="{' border-red-400': formValidate.has_cancer}" type="text" placeholder="Family Member*" name="familyMemberCancer" class="border shadow-sm rounded text-sm focus:outline-none focus:shadow-none text-brand focus:ring-transparent w-full">
                </div>

                <div class="flex justify-between items-center pt-1 text-red-400" v-if="formValidate.has_cancer">
                    <p class="text-xs" v-html="formValidate.has_cancer"></p>
                    <svg width="16" height="16">
                        <use xlink:href="#rejected"></use>
                    </svg>
                </div>


            </div>
            <div class="w-full mb-3 flex flex-col">
                <p class="mr-2 text-md text-brand dark:text-white font-bold font-montserrat">Heart Disease (heart attacks, angina)</p>
                <div class="flex sm:flex-row flex-col mt-2">
                    <label class="inline-flex items-center mr-3">
                        <input type="radio" name="has_heart_disease" class="text-brand dark:text-green-500" value="Yes" @change="chooseUser.has_heart_disease = ''; chooseUser.heartdiseaseToggle = 'Yes'" :checked="chooseUser.has_heart_disease != 'No'">
                        <span class="ml-2 text-md text-brand dark:text-white">Yes</span>
                    </label>
                    <label class="inline-flex items-center mr-3">
                        <input type="radio" name="has_heart_disease" class="text-brand dark:text-green-500" value="No" v-model="chooseUser.has_heart_disease" @change="chooseUser.heartdiseaseToggle = ''">
                        <span class="ml-2 text-md text-brand dark:text-white">No</span>
                    </label>
                    <input v-if="chooseUser.heartdiseaseToggle || chooseUser.has_heart_disease != 'No'" v-model="chooseUser.has_heart_disease" :class="{' border-red-400': formValidate.has_heart_disease}" type="text" placeholder="Family Member*" name="familyMemberHeartDisease" class="border shadow-sm rounded text-sm focus:outline-none focus:shadow-none text-brand focus:ring-transparent w-full">
                </div>

                <div class="flex justify-between items-center pt-1 text-red-400" v-if="formValidate.has_heart_disease">
                    <p class="text-xs" v-html="formValidate.has_heart_disease"></p>
                    <svg width="16" height="16">
                        <use xlink:href="#rejected"></use>
                    </svg>
                </div>


            </div>
            <div class="w-full mb-3 flex flex-col">

                <p class="mr-2 text-md text-brand dark:text-white font-bold font-montserrat">Stroke</p>
                <div class="flex sm:flex-row flex-col mt-2">
                    <label class="inline-flex items-center mr-3">
                        <input type="radio" name="has_stroke" class="text-brand dark:text-green-500" value="Yes" @change="chooseUser.has_stroke = ''; chooseUser.strokeToggle = 'Yes'" :checked="chooseUser.has_stroke != 'No'">
                        <span class="ml-2 text-md text-brand dark:text-white">Yes</span>
                    </label>
                    <label class="inline-flex items-center mr-3">
                        <input type="radio" name="has_stroke" class="text-brand dark:text-green-500" value="No" v-model="chooseUser.has_stroke" @change="chooseUser.strokeToggle = ''">
                        <span class="ml-2 text-md text-brand dark:text-white">No</span>
                    </label>
                    <input v-if="chooseUser.strokeToggle || chooseUser.has_stroke != 'No'" v-model="chooseUser.has_stroke" :class="{' border-red-400': formValidate.has_stroke}" type="text" placeholder="Family Member*" name="familyMemberstroke" class="border shadow-sm rounded text-sm focus:outline-none focus:shadow-none text-brand focus:ring-transparent w-full">
                </div>

                <div class="flex justify-between items-center pt-1 text-red-400" v-if="formValidate.has_stroke">
                    <p class="text-xs" v-html="formValidate.has_stroke"></p>
                    <svg width="16" height="16">
                        <use xlink:href="#rejected"></use>
                    </svg>
                </div>


            </div>
            <div class="w-full mb-3 flex flex-col">

                <p class="mr-2 text-md text-brand dark:text-white font-bold font-montserrat">Other (Please Specify)</p>
                <div class="flex sm:flex-row flex-col mt-2">
                    <label class="inline-flex items-center mr-3">
                        <input type="radio" name="has_other" class="text-brand dark:text-green-500" value="Yes" @change="chooseUser.has_other = ''; chooseUser.otherToggle = 'Yes' " :checked="chooseUser.has_other != 'No' ">
                        <span class="ml-2 text-md text-brand dark:text-white">Yes</span>
                    </label>
                    <label class="inline-flex items-center mr-3">
                        <input type="radio" name="has_other" class="text-brand dark:text-green-500" value="No" v-model="chooseUser.has_other" @change="chooseUser.otherToggle = ''">
                        <span class="ml-2 text-md text-brand dark:text-white">No</span>
                    </label>
                    <input v-if="chooseUser.otherToggle || chooseUser.has_other != 'No'" v-model="chooseUser.has_other" :class="{' border-red-400': formValidate.has_other}" type="text" placeholder="Condition - Family Member*" name="familyMemberOther" class="border shadow-sm rounded text-sm focus:outline-none focus:shadow-none text-brand focus:ring-transparent w-full">
                </div>

                <div class="flex justify-between items-center pt-1 text-red-400" v-if="formValidate.has_other">
                    <p class="text-xs" v-html="formValidate.has_other"></p>
                    <svg width="16" height="16">
                        <use xlink:href="#rejected"></use>
                    </svg>
                </div>


            </div>
            <!-- Family Medical History End -->

            <!-- Allergies Start -->
            <p class="w-full font-montserrat font-bold sm:text-lg text-md text-brand dark:text-white mb-3 flex flex-col">Allergies*</p>
            <div class="w-full mb-3 flex flex-col">

                <p class="mr-2 text-sm text-brand dark:text-white font-bold font-montserrat">Are you allergic to any medicines, substances or foods?</p>
                <div class="flex sm:flex-row flex-col mt-2">
                    <label class="inline-flex items-center mr-3">
                        <input type="radio" name="allergy_details" class="text-brand dark:text-green-500" value="Yes" @change="chooseUser.allergy_details = ''; chooseUser.allergyToggle == 'Yes'" :checked="chooseUser.allergy_details != 'No'">
                        <span class="ml-2 text-md text-brand dark:text-white">Yes</span>
                    </label>
                    <label class="inline-flex items-center mr-3">
                        <input type="radio" name="allergy_details" class="text-brand dark:text-green-500" value="No" v-model="chooseUser.allergy_details" @change="chooseUser.allergyToggle = ''">
                        <span class="ml-2 text-md text-brand dark:text-white">No</span>
                    </label>
                    <input v-if="chooseUser.allergyToggle || chooseUser.allergy_details != 'No'" v-model="chooseUser.allergy_details" :class="{' border-red-400': formValidate.allergy_details}" type="text" placeholder="Allergy Details*" name="familyMemberallergy" class="border shadow-sm rounded text-sm focus:outline-none focus:shadow-none text-brand focus:ring-transparent w-full">
                </div>

                <div class="flex justify-between items-center pt-1 text-red-400" v-if="formValidate.allergy_details">
                    <p class="text-xs" v-html="formValidate.allergy_details"></p>
                    <svg width="16" height="16">
                        <use xlink:href="#rejected"></use>
                    </svg>
                </div>


            </div>
            <!-- Allergies End -->

            <!-- Lifestyle Start -->
            <p class="w-full font-montserrat font-bold sm:text-lg text-md text-brand dark:text-white mb-3 flex flex-col">Lifestyle*</p>
            <div class="sm:w-1/4 w-full mb-3 flex flex-col sm:px-2">
                <p class="w-full pb-2 text-sm font-bold text-brand dark:text-white">Do you exercise regularly?</p>
                <div class="flex sm:flex-row flex-col mt-2">
                    <label class="inline-flex items-center mr-2">
                        <input v-model="chooseUser.exercise" type="radio" checked="" name="exercise-regular" class="text-brand dark:text-green-500" value="Ye">
                        <span class="ml-2 text-xs text-brand dark:text-white mb-2">Yes</span>
                    </label>
                    <label class="inline-flex items-center">
                        <input v-model="chooseUser.exercise" type="radio" name="exercise-regular" class="text-brand dark:text-white" value="No">
                        <span class="ml-2 text-xs text-brand dark:text-white mb-2">No</span>
                    </label>
                </div>
                <div class="flex justify-between items-center pt-1 text-red-400" v-if="formValidate.exercise">
                    <p class="text-xs" v-html="formValidate.exercise"></p>
                    <svg width="16" height="16">
                        <use xlink:href="#rejected"></use>
                    </svg>
                </div>
            </div>
            <div class="sm:w-1/4 w-full mb-3 flex flex-col sm:px-2">
                <label for="exercise_minutes" class="pb-2 text-sm font-bold text-brand dark:text-white">How many minutes do you excerise per session*</label>
                <input v-model="chooseUser.exercise_minutes" :class="{' border-red-400': formValidate.exercise_minutes}" type="number" placeholder="Minutes*" name="exercise_minutes" class="border shadow-sm rounded text-sm focus:outline-none focus:shadow-none text-brand focus:ring-transparent" min="0">
                <div class="flex justify-between items-center pt-1 text-red-400" v-if="formValidate.exercise_minutes">
                    <p class="text-xs" v-html="formValidate.exercise_minutes"></p>
                    <svg width="16" height="16">
                        <use xlink:href="#rejected"></use>
                    </svg>
                </div>
            </div>
            <div class="sm:w-1/4 w-full mb-3 flex flex-col sm:px-2">
                <label for="exercise_days" class="pb-2 text-sm font-bold text-brand dark:text-white">How many days do you exercise in a typical week*</label>
                <input v-model="chooseUser.exercise_days" :class="{' border-red-400': formValidate.exercise_days}" type="number" placeholder="days*" name="exercise_days" class="border shadow-sm rounded text-sm focus:outline-none focus:shadow-none text-brand focus:ring-transparent" min="0" max="7">
                <div class="flex justify-between items-center pt-1 text-red-400" v-if="formValidate.exercise_days">
                    <p class="text-xs" v-html="formValidate.exercise_days"></p>
                    <svg width="16" height="16">
                        <use xlink:href="#rejected"></use>
                    </svg>
                </div>
            </div>
            <div class="sm:w-1/4 w-full mb-3 flex flex-col sm:px-2">
                <label for="diet" class="pb-2 text-sm font-bold text-brand dark:text-white">Which one of the following best describes your diet?*</label>
                <input v-model="chooseUser.diet" :class="{' border-red-400': formValidate.diet}" type="text" placeholder="diet*" name="diet" class="border shadow-sm rounded text-sm focus:outline-none focus:shadow-none text-brand focus:ring-transparent" list="diet">
                <datalist id="diet">
                    <option>Good</option>
                    <option>Average</option>
                    <option>Poor</option>
                    <option>Vegetarian</option>
                    <option>Vegan</option>
                    <option>Low Fat</option>
                    <option>Low salt</option>
                </datalist>
                <div class="flex justify-between items-center pt-1 text-red-400" v-if="formValidate.diet">
                    <p class="text-xs" v-html="formValidate.diet"></p>
                    <svg width="16" height="16">
                        <use xlink:href="#rejected"></use>
                    </svg>
                </div>
            </div>
            <!-- Lifestyle End -->

        </div>
        <!-- Step 4 End -->

        <button v-if="currentStep > 1" class="float-left transform hover:scale-105 motion-reduce:transform-none focus:outline-none bg-tomato-500 transition duration-150 text-white ease-in-out rounded px-4 sm:px-8 py-2 text-xs sm:text-sm font-bold my-2" @click="currentStep -= 1">Previous</button>

        <button v-if="currentStep < maxSteps" class="float-right transform hover:scale-105 motion-reduce:transform-none focus:outline-none bg-tomato-500 transition duration-150 text-white ease-in-out rounded px-4 sm:px-8 py-2 text-xs sm:text-sm font-bold my-2" @click="chooseUser.GUID == <?= $this->session->userdata('userID'); ?> ? validateStep(currentStep) : currentStep += 1">Next</button>

        <button v-if="chooseUser.GUID == <?= $this->session->userdata('userID'); ?> && currentStep == maxSteps" class="float-right my-2 transform hover:scale-105 motion-reduce:transform-none focus:outline-none bg-green-400 transition duration-150 text-white ease-in-out rounded px-4 sm:px-8 py-2 text-xs sm:text-sm font-bold" @click="updateUser()">Update User</button>

        <div class="clear-both"></div>

    </div>

</div>