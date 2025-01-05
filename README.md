
# YouHealHospital

YouHealHospital is a comprehensive hospital management system built with Laravel. It provides an efficient platform for managing doctors, patients, and appointments while ensuring a seamless user experience for all roles (Admin, Doctor, and Patient).

## Project Description

The system is designed to:
- Allow **admins** to manage doctors, patients, departments, appointments, and schedules.
- Enable **patients** to book appointments with doctors, view previous medical reports, and access personal profiles.
- Allow **doctors** to view appointments, examine patients, and update medical reports visible on the patient dashboard.

This project streamlines hospital operations, enhances patient care, and provides a user-friendly interface for managing key functionalities.

## Key Features

### For Patients:
- Book appointments by selecting a doctor and date.
- View previous medical reports.
- Manage personal profiles.

### For Doctors:
- View and manage patient appointments.
- Examine patients and update medical reports.
- Manage personal profiles.

### For Admins:
- Manage doctors, patients, and departments.
- Manage doctor schedules and appointment dates.
- Oversee and monitor hospital activities.

## Installation Steps

Follow these steps to set up the project on your local machine:

1. **Clone the repository**:
   ```bash
   git clone https://github.com/your-username/youhealhospital.git
   ```
2. **Navigate to the project directory**:
   ```bash
   cd youhealhospital
   ```
3. **Install PHP dependencies**:
   ```bash
   composer install
   ```
4. **Install frontend dependencies**:
   ```bash
   npm install
   npm run dev
   ```
5. **Set up the environment file**:
   - Copy the `.env.example` file to `.env`:
     ```bash
     cp .env.example .env
     ```
   - Update the `.env` file with your database credentials and other configurations.

6. **Generate the application key**:
   ```bash
   php artisan key:generate
   ```

7. **Run database migrations and seed data**:
   ```bash
   php artisan migrate --seed
   ```

8. **Start the development server**:
   ```bash
   php artisan serve
   ```

9. **Access the application**:
   - Open your browser and navigate to `http://127.0.0.1:8000`.

## Technologies Used

- **Backend**: Laravel
- **Frontend**: Bootstrap, JavaScript, HTML
- **Database**: MySQL

## Author

This project was developed by **Suranga Prabash**.

## License

This project is open-sourced software licensed under the [MIT License](https://opensource.org/licenses/MIT).
