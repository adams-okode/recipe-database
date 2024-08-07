## Project Setup Guide

Follow these steps to set up and run the project on your local machine. This guide covers both the backend and frontend parts of the application.

### Backend Setup

1. **Clone the Repository**

   First, clone the repository to your local machine using the following command:

   ```bash
   git clone git@github.com:adams-okode/recipe-database.git
   ```

2. **Copy Environment Variables**

   Navigate to the project directory and copy the sample environment file to create your own `.env` file:

   ```bash
   cp .env.sample .env
   ```

   Make sure to update the `.env` file with any necessary configuration specific to your local setup (such as database credentials, API keys, etc.).

3. **Start Docker Containers**

   Use Docker Compose to build and start the containers:

   ```bash
   docker-compose up -d --build
   ```

   - `-d`: Runs the containers in detached mode (in the background).
   - `--build`: Forces a rebuild of the Docker images.

4. **Attach to the Backend Shell**

   Once the containers are running, attach to the backend container to access the shell:

   ```bash
   docker-compose exec -it app sh
   ```

   - `exec -it`: Executes a command in a running container with an interactive terminal.
   - `app`: Replace `app` with the actual service name defined in your `compose.yml` file if it's different.

5. **Generate Test Data**

   Run the following command to migrate the database and seed it with test data:

   ```bash
   php artisan migrate:fresh --seed
   ```

   - `migrate:fresh`: Drops all tables and re-runs all migrations.
   - `--seed`: Seeds the database with test data as defined in your database seeder classes.

### Frontend Setup

1. **Navigate to the Frontend Directory**

   Change to the frontend directory:

   ```bash
   cd frontend
   ```

2. **Install Dependencies**

   Install the required Node.js dependencies:

   ```bash
   npm install
   ```

   This will install all packages specified in the `package.json` file.

3. **Run the Development Server**

   Start the development server with the following command:

   ```bash
   npm run dev
   ```

   This will compile the frontend assets and start a development server.

4. **Open the Application in Your Browser**

   Open your browser and navigate to:

   ```
   http://localhost:5173
   ```

   You should see the application running.

---

### Additional Notes

- **Environment Configuration**: Ensure that the `.env` file contains all the necessary environment variables required for your application to run correctly.
- **Docker Configuration**: Verify that your `compose.yml` file correctly specifies the service configurations, such as ports, volumes, and environment variables.

- **Frontend Development Server**: The default port for Vite (used by many modern JavaScript frameworks) is `5173`. If you encounter issues or need a different port, you can modify the `vite.config.js` or equivalent configuration file.

- **Troubleshooting**: If you encounter any issues during setup, check the logs using `docker-compose logs` for more details, and ensure all dependencies and tools (Docker, Node.js, etc.) are properly installed on your machine.

This setup guide should provide a comprehensive overview of how to get your project up and running. Let me know if you need any further assistance or have specific questions!
