



  <nav class="flex flex-wrap items-center justify-between p-3  border-gray-200 dark:bg-gray-900">
    {{-- <img src="https://tailwindflex.com/public/favicon.ico" class="h-10 w-10" alt="ACME" width="120" /> --}}
    <div class="flex md:hidden">
        <button id="hamburger">
          <img class="toggle block" src="https://img.icons8.com/fluent-systems-regular/2x/menu-squared-2.png" width="40" height="40" />
          <img class="toggle hidden" src="https://img.icons8.com/fluent-systems-regular/2x/close-window.png" width="40" height="40" />
        </button>
    </div>
    <div class="toggle hidden w-full md:w-auto md:flex text-right text-bold mt-5 md:mt-0 border-t-2 border-blue-900 md:border-none" id="navbar-default">

      @if(auth()->user()->can('accounting.manage_accounts'))

        <a href="{{ action([\Modules\Accounting\Http\Controllers\CoaController::class, 'index']) }}" class="block md:inline-block text-blue-900 hover:text-blue-500 px-3 py-3 border-b-2 border-blue-900 md:border-none">@lang('accounting::lang.chart_of_accounts')</a>
        @endif
        @if(auth()->user()->can('accounting.view_journal'))

        <a  href="{{ action([\Modules\Accounting\Http\Controllers\JournalEntryController::class, 'index']) }}" class="block md:inline-block text-blue-900 hover:text-blue-500 px-3 py-3 border-b-2 border-blue-900 md:border-none">@lang('accounting::lang.journal_entry')</a>

        @endif
        @if(auth()->user()->can('accounting.view_transfer'))

        <a href="{{ action([\Modules\Accounting\Http\Controllers\TransferController::class, 'index']) }}" class="block md:inline-block text-blue-900 hover:text-blue-500 px-3 py-3 border-b-2 border-blue-900 md:border-none">@lang('accounting::lang.transfer')</a>


        <a href="{{ action([\Modules\Accounting\Http\Controllers\TransactionController::class, 'index']) }}" class="block md:inline-block text-blue-900 hover:text-blue-500 px-3 py-3 border-b-2 border-blue-900 md:border-none">@lang('accounting::lang.transactions')</a>
        @endif

        @if(auth()->user()->can('accounting.manage_budget'))

        <a href="{{ action([\Modules\Accounting\Http\Controllers\BudgetController::class, 'index']) }}"  class="block md:inline-block text-blue-900 hover:text-blue-500 px-3 py-3 border-b-2 border-blue-900 md:border-none">@lang('accounting::lang.budget')</a>

        @endif
        @if(auth()->user()->can('accounting.view_reports'))

        
        <a href="{{ action([\Modules\Accounting\Http\Controllers\ReportController::class, 'index']) }}" class="block md:inline-block text-blue-900 hover:text-blue-500 px-3 py-3 border-b-2 border-blue-900 md:border-none">@lang('accounting::lang.reports')</a>
        @endif

 
        <a  href="{{ action([\Modules\Accounting\Http\Controllers\SettingsController::class, 'index']) }}" class="block md:inline-block text-blue-900 hover:text-blue-500 px-3 py-3 border-b-2 border-blue-900 md:border-none">@lang('messages.settings')</a>

    </div>
    {{-- <a href="#" class="toggle hidden md:flex w-full md:w-auto px-4 py-2 text-right bg-blue-900 hover:bg-blue-500 text-white md:rounded">Create Account</a> --}}
    {{-- <a  href="{{route('accounting.ca')}}">@lang('messages.settings')</a> --}}

   
         
            <a  href="{{ action([\Modules\Accounting\Http\Controllers\AccountingController::class, 'dashboard']) }}" class="block md:inline-block text-blue-900 hover:text-blue-500 px-3 py-3 border-b-2 border-blue-900 md:border-none">   <i class="fas fa-broadcast-tower"></i> {{ __('accounting::lang.accounting') }}</a>
</nav>

<script>
    document.getElementById("hamburger").onclick = function toggleMenu() {
        const navToggle = document.getElementsByClassName("toggle");
        for (let i = 0; i < navToggle.length; i++) {
          navToggle.item(i).classList.toggle("hidden");
        }
      };
</script>




