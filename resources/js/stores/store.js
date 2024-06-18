import { defineStore } from "pinia";
import axios from "../axios";

export const useEmployeeStore = defineStore("employee", {
    state: () => ({
        employees: [],
    }),
    actions: {
        async fetchEmployees() {
            try {
                const response = await axios.get("/employees"); // Assuming this endpoint returns employee data with associated skills
                this.employees = response.data.map((employee) => {
                    return {
                        ...employee,
                        skills: employee.skills.map((skill) => skill.skill), // Assuming skills is an array of objects with a 'skill' property
                        skillIds: employee.skills.map((skill) => skill.id), // Extracting only skill IDs
                        // skills: employee.skills.map((skill) => ({
                        //     id: skill.id,
                        //     skill: skill.skill,
                        // })),
                    };
                });
            } catch (error) {
                console.error("Error fetching employees:", error);
            }
        },
        async addEmployee(employeeData) {
            try {
                const employeeResponse = await axios.post("/employees", {
                    first_name: employeeData.firstName,
                    last_name: employeeData.lastName,
                    field_of_employment: employeeData.fieldOfEmployment,
                    about: employeeData.about,
                    available: employeeData.status,
                });
                const employeeId = employeeResponse.data.id;

                for (const skill of employeeData.skills) {
                    await axios.post(`/employees/${employeeId}/skills`, {
                        skill,
                    });
                }

                await this.fetchEmployees();
            } catch (error) {
                console.error("Error adding employee or skills:", error);
            }
        },
        async updateEmployee(employeeData) {
            try {
                await axios.put(`/employees/${employeeData.id}`, {
                    first_name: employeeData.firstName,
                    last_name: employeeData.lastName,
                    field_of_employment: employeeData.fieldOfEmployment,
                    about: employeeData.about,
                    available: employeeData.status,
                    skills: employeeData.skills,
                });
                await this.fetchEmployees();
            } catch (error) {
                console.error("Error updating employee or skills:", error);
            }
        },
        async deleteByEmployeeId(employeeId) {
            try {
                await axios.delete(`/employees/${employeeId}`);
                await this.fetchEmployees();
            } catch (error) {
                console.error("Error deleting employee:", error);
            }
        },
        async updateEmployeeStatus(employeeId, status) {
            try {
                await axios.patch(`/employees/${employeeId}`, {
                    available: status,
                });
                await this.fetchEmployees();
            } catch (error) {
                console.error("Error updating employee status:", error);
            }
        },
        async deleteSkill(employeeId, skillId) {
            try {
                await axios.delete(`/employee-skills/${employeeId}/${skillId}`);
                return true; // Return true on successful deletion
            } catch (error) {
                console.error("Error deleting skill:", error);
                return false; // Return false if deletion fails
            }
        },
        getEmployeeById(id) {
            return this.employees.find((employee) => employee.id === id);
        },
    },
});
