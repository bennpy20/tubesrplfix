<aside id="logo-sidebar"
    class="sticky pt-5 z-40 w-64 h-screen transition-transform -translate-x-full bg-white border-r border-gray-200 sm:translate-x-0 dark:bg-gray-800 dark:border-gray-700"
    aria-label="Sidebar">
    <div class="h-full px-3 py-1 overflow-y-auto bg-white dark:bg-gray-800">
        <ul class="space-y-2 font-medium">
            <li>
                <x-aside-link href="/" :active="request()->is('/')">
                    <svg class="w-6 h-6 text-gray-500 transition duration-75 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white"
                        aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 25 24">
                        <path
                            d="M11.293 3.293a1 1 0 0 1 1.414 0l6 6 2 2a1 1 0 0 1-1.414 1.414L19 12.414V19a2 2 0 0 1-2 2h-3a1 1 0 0 1-1-1v-3h-2v3a1 1 0 0 1-1 1H7a2 2 0 0 1-2-2v-6.586l-.293.293a1 1 0 0 1-1.414-1.414l2-2 6-6Z" />
                    </svg>
                    <span class="flex-1 ms-2 whitespace-nowrap">Dashboard</span>
                </x-aside-link>
            </li>
            <li>
                <x-aside-link href="/dompets" :active="request()->is('/dompets')">
                    <svg class="flex-shrink-0 w-6 h-6 text-gray-500 transition duration-75 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white"
                        aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24">
                        <path fill-rule="evenodd"
                            d="M12 14a3 3 0 0 1 3-3h4a2 2 0 0 1 2 2v2a2 2 0 0 1-2 2h-4a3 3 0 0 1-3-3Zm3-1a1 1 0 1 0 0 2h4v-2h-4Z"
                            clip-rule="evenodd" />
                        <path fill-rule="evenodd"
                            d="M12.293 3.293a1 1 0 0 1 1.414 0L16.414 6h-2.828l-1.293-1.293a1 1 0 0 1 0-1.414ZM12.414 6 9.707 3.293a1 1 0 0 0-1.414 0L5.586 6h6.828ZM4.586 7l-.056.055A2 2 0 0 0 3 9v10a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2h-4a5 5 0 0 1 0-10h4a2 2 0 0 0-1.53-1.945L17.414 7H4.586Z"
                            clip-rule="evenodd" />
                    </svg>
                    <span class="flex-1 ms-2 whitespace-nowrap">Dompet</span>
                </x-aside-link>
            </li>
            <li>
                <x-aside-link href="/transaksis" :active="request()->is('/transaksis')">
                    <svg class="flex-shrink-0 w-5 h-5 text-gray-500 transition duration-75 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white"
                        aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 16 20">
                        <path
                            d="M17 5.923A1 1 0 0 0 16 5h-3V4a4 4 0 1 0-8 0v1H2a1 1 0 0 0-1 .923L.086 17.846A2 2 0 0 0 2.08 20h13.84a2 2 0 0 0 1.994-2.153L17 5.923ZM7 9a1 1 0 0 1-2 0V7h2v2Zm0-5a2 2 0 1 1 4 0v1H7V4Zm6 5a1 1 0 1 1-2 0V7h2v2Z" />
                    </svg>
                    <span class="flex-1 ms-3 whitespace-nowrap">Transaksi</span>
                </x-aside-link>
            </li>
            <li>
                <x-aside-link href="/budgets" :active="request()->is('/budgets')">
                    <svg class="flex-shrink-0 w-6 h-6 text-gray-500 transition duration-75 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white"
                        aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                        fill="none" viewBox="0 0 24 24">
                        <path fill="currentColor"
                            d="M3.69869 6.31701C2.56717 5.02384 3.48553 3 5.20384 3H18.7547c1.7316 0 2.6449 2.05088 1.4866 3.33793L17.47 9.34198s-.4632-.20588-.6184-.24042c-.1551-.03453-.488-.10604-.9206-.10604-.9034 0-2.138.66073-2.5716 1.73108-1.3256.8485-1.6921 1.8133-1.7929 2.0078-.1009.1944-.2618.5312-.3399 1.2148-.0781.6836 0 1.6055.5235 2.4688-.0721.0626-.2383.289-.3321.4375-.0937.1484-.5898.875-.3515 2.1445-.1993 0-.6387-.158-.92-.4393l-.70708-.7071c-.28131-.2814-.43934-.6629-.43934-1.0607v-4.4172L3.69869 6.31701Z" />
                        <path fill="currentColor" fill-rule="evenodd"
                            d="M16.0604 11c.5523 0 1 .4477 1 1v.1013c.6366.1591 1.2184.4937 1.668.9715.3784.4022.3592 1.0351-.0431 1.4135-.4022.3785-1.0351.3592-1.4135-.043-.1902-.2021-.4506-.3504-.7488-.4139-.0363-.0077-.0722-.0174-.1074-.0292-.0543-.018-.1098-.0317-.1658-.041-.0614.0117-.1247.0179-.1894.0179-.063 0-.1245-.0058-.1843-.017-.0784.0136-.1554.0355-.2292.0658-.1976.0812-.3513.2132-.4504.3673.0006.002.0013.0042.002.0064.0138.0431.0516.1195.1396.2154.1806.1971.4983.3934.8907.4835.746.1712 1.4369.5572 1.9192 1.0838.476.5197.8461 1.3054.5891 2.1704-.0136.0459-.0305.0907-.0506.1342-.3123.6768-.8768 1.2008-1.5636 1.483-.0208.0085-.0416.0168-.0625.0248V20c0 .5523-.4477 1-1 1-.5271 0-.9589-.4077-.9973-.9249-.0154-.0046-.0308-.0093-.0462-.0141-.6707-.1541-1.2837-.502-1.7506-1.0062-.3752-.4053-.3509-1.038.0544-1.4132.4052-.3752 1.0379-.3508 1.4131.0544.1903.2055.4527.3566.754.4209.0359.0077.0713.0173.1061.0289.0754.025.1531.0416.2315.0499.0753-.0181.154-.0277.235-.0277.0421 0 .0836.0026.1244.0076.0608-.0134.1204-.032.1781-.0557.1979-.0813.3518-.2135.451-.368l-.001-.0032c-.0136-.0424-.0513-.1189-.1398-.2156-.1817-.1984-.5007-.3955-.8919-.4854-.7448-.171-1.4351-.5549-1.9176-1.0814-.4776-.5211-.8432-1.304-.5924-2.167.0138-.0477.0312-.0943.052-.1394.312-.6773.8766-1.2017 1.5637-1.4839.0573-.0236.1151-.0453.1735-.0653V12c0-.5523.4477-1 1-1Z"
                            clip-rule="evenodd" />
                    </svg>
                    <span class="flex-1 ms-2 whitespace-nowrap">Budget</span>
                </x-aside-link>
            </li>
            <li class="pt-4 mt-4 space-y-2 font-medium border-t border-gray-200 dark:border-gray-700">
                <x-aside-link href="/profiles" :active="request()->is('/profiles')">
                    <svg class="flex-shrink-0 w-6 h-6 text-gray-500 transition duration-75 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white"
                        aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                        fill="currentColor" viewBox="0 0 24 24">
                        <path fill-rule="evenodd"
                            d="M12 20a7.966 7.966 0 0 1-5.002-1.756l.002.001v-.683c0-1.794 1.492-3.25 3.333-3.25h3.334c1.84 0 3.333 1.456 3.333 3.25v.683A7.966 7.966 0 0 1 12 20ZM2 12C2 6.477 6.477 2 12 2s10 4.477 10 10c0 5.5-4.44 9.963-9.932 10h-.138C6.438 21.962 2 17.5 2 12Zm10-5c-1.84 0-3.333 1.455-3.333 3.25S10.159 13.5 12 13.5c1.84 0 3.333-1.455 3.333-3.25S13.841 7 12 7Z"
                            clip-rule="evenodd" />
                    </svg>
                    <span class="flex-1 ms-2 whitespace-nowrap">Profil</span>
                </x-aside-link>
            </li>
        </ul>
    </div>
</aside>
