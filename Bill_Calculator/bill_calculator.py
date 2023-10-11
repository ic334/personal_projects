from datetime import datetime, timedelta

# Function to calculate account balance


def calculate_account_balance(bills, initial_income, payday, start_date, current_balance, stop_date, non_monthly_payments=[]):
    account_balance = current_balance
    income = initial_income
    current_date = start_date
    next_payday = payday

    # Print column headers
    print("{:<20} {:<30} {:<12} {:<12} {:<15} {:<15} {:<12}".format(
        "Date", "Name", "Income", "Non-Monthly", "Deduction", "Balance", "Withdrawable"))

    while current_date <= stop_date:
        monthly_bills_due = [
            bill for bill in bills if bill['due_date'] == current_date.day]

        if current_date == next_payday:
            account_balance += income
            withdrawable = account_balance - \
                sum(bill['amount'] for bill in bills)
            print("{:<20} {:<30} {:<12.2f} {:<12} {:<15} {:<15.2f} {:<12.2f}".format(
                current_date.strftime('%Y-%m-%d'), "Payday", income, "", "", account_balance, max(0, withdrawable)))
            next_payday += timedelta(days=14)

        for bill in monthly_bills_due:
            deduction = -bill['amount']  # Deduction is now negative
            account_balance += deduction
            print("{:<20} {:<30} {:<12} {:<12} {:<15.2f} {:<15.2f} {:<12}".format(
                current_date.strftime('%Y-%m-%d'), bill['name'], "", "", deduction, account_balance, ""))

        for payment in non_monthly_payments:
            if current_date == payment['date']:
                if payment['amount'] < 0:
                    payment_name = payment['name']
                    deduction = payment['amount']
                    account_balance += deduction
                    # Print non-monthly transactions for the current day
                    print("{:<20} {:<30} {:<12} {:<12.2f} {:<15} {:<15.2f} {:<12}".format(
                        current_date.strftime('%Y-%m-%d'), payment_name, "", deduction, "", account_balance, ""))
                else:
                    payment_name = payment['name']
                    print("{:<20} {:<30} {:<12.2f} {:<12} {:<15} {:<15.2f} {:<12}".format(
                        payment['date'].strftime('%Y-%m-%d'), payment['name'], payment['amount'], "", "", account_balance, ""))
                    account_balance += payment['amount']

        current_date += timedelta(days=1)

        # Print dashes at the beginning of each month
        if current_date.day == 1:
            print("-" * 125)


# List of monthly bills with due dates (as day numbers)
bills = [
    {'name': 'Rent', 'amount': 3000, 'due_date': 1},
    {'name': 'Gorceries', 'amount': 500, 'due_date': 1}
    # Add more bills as needed
]

# List of non-monthly payments with name, amount (positive or negative), and date
non_monthly_payments = [
    {'name': 'Car Repair', 'amount': -200, 'date': datetime(2023, 11, 3)},
    {'name': 'Bonus', 'amount': 600, 'date': datetime(2023, 11, 3)}
    # Add more non-monthly payments as needed
]

# Input your bi-weekly income, current account balance, start date, and payday
income = float(input("Enter your bi-weekly income: "))
current_balance = float(input("Enter your current account balance: "))
start_date_str = input("Enter the start date (YYYY-MM-DD): ")
start_date = datetime.strptime(start_date_str, "%Y-%m-%d")
payday_str = input("Enter your payday (YYYY-MM-DD): ")
payday = datetime.strptime(payday_str, "%Y-%m-%d")
stop_date_str = input("Enter the stop date (YYYY-MM-DD): ")
stop_date = datetime.strptime(stop_date_str, "%Y-%m-%d")

# Calculate and print the account balance
calculate_account_balance(bills, income, payday, start_date,
                          current_balance, stop_date, non_monthly_payments)
