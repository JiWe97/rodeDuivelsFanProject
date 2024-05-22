# Rode Duivels Fan Project

This project is aimed at managing data for Rode Duivels fans, allowing for the import of fan data from CSV files into a database.

## Installation

To get started with this project, follow these steps:

1. **Clone the repository:**
   ```bash
   git clone https://github.com/JiWe97/rodeDuivelsFanProject.git
   ```

2. **Install dependencies:**
   ```bash
   composer install
   ```

3. **Database Configuration:**
   - Make sure you have a database server (e.g., MySQL) installed and running.
   - Configure your database connection settings in the `.env` file.

4. **Create the Database:**
   ```bash
   php bin/console doctrine:database:create
   ```

5. **Run Migrations:**
   ```bash
   php bin/console doctrine:migrations:migrate
   ```

6. **Import CSV Data:**
   ```bash
   php bin/console app:import-csv
   ```

## Usage

- **Importing CSV Data:**
  Use the `app:import-csv` command to import fan data from a CSV file into the database.

- **Updating CSV Data:**
  Modify the CSV file with the desired changes and run the `app:import-csv` command again to update the database.

## License

This project is licensed under the MIT License - see the [LICENSE](LICENSE) file for details.
