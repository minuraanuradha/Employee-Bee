// SPDX-License-Identifier: MIT
pragma solidity ^0.8.20;

contract EmploymentRecord {
    struct CareerRecord {
        string companyId;
        string roleTitle;
        string skillsOnHire;
        string newSkills; // Added for exit movement
        uint256 startDate;
        uint256 endDate;
        string status;
        string feedbackText;
        address addedBy;
        uint256 blockTimestamp;
    }

    mapping(string => CareerRecord[]) private employeeRecords;

    event RecordAdded(string indexed employeeId, uint256 index, string companyId, string status);
    event RecordUpdated(string indexed employeeId, uint256 index, string status);
    event RecordExited(string indexed employeeId, uint256 index, string status);

    // Add a new employment record (hire)
    function addEmploymentRecord(
        string memory employeeId,
        string memory companyId,
        string memory roleTitle,
        string memory skillsOnHire,
        uint256 startDate
    ) public {
        CareerRecord memory record = CareerRecord({
            companyId: companyId,
            roleTitle: roleTitle,
            skillsOnHire: skillsOnHire,
            newSkills: \"\",
            startDate: startDate,
            endDate: 0,
            status: \"active\",
            feedbackText: \"\",
            addedBy: msg.sender,
            blockTimestamp: block.timestamp
        });
        employeeRecords[employeeId].push(record);
        emit RecordAdded(employeeId, employeeRecords[employeeId].length - 1, companyId, \"active\");
    }

    // Update an existing record (promotion, skill update, etc.)
    function updateEmploymentRecord(
        string memory employeeId,
        uint256 recordIndex,
        string memory newRoleTitle,
        string memory newSkillsOnHire,
        string memory newStatus,
        string memory feedbackText
    ) public {
        require(recordIndex < employeeRecords[employeeId].length, \"Invalid record index\");
        CareerRecord storage record = employeeRecords[employeeId][recordIndex];
        require(record.addedBy == msg.sender, \"Only the company that added this record can update it\");
        record.roleTitle = newRoleTitle;
        record.skillsOnHire = newSkillsOnHire;
        record.status = newStatus;
        record.feedbackText = feedbackText;
        emit RecordUpdated(employeeId, recordIndex, newStatus);
    }

    // Mark an employee as exited (resigned, terminated, etc.) and add new skills
    function exitEmploymentRecord(
        string memory employeeId,
        uint256 recordIndex,
        uint256 endDate,
        string memory newStatus,
        string memory feedbackText,
        string memory newSkills
    ) public {
        require(recordIndex < employeeRecords[employeeId].length, \"Invalid record index\");
        CareerRecord storage record = employeeRecords[employeeId][recordIndex];
        require(record.addedBy == msg.sender, \"Only the company that added this record can exit it\");
        record.endDate = endDate;
        record.status = newStatus;
        record.feedbackText = feedbackText;
        record.newSkills = newSkills;
        emit RecordExited(employeeId, recordIndex, newStatus);
    }

    // Get all career records for an employee
    function getEmployeeRecords(string memory employeeId) public view returns (CareerRecord[] memory) {
        return employeeRecords[employeeId];
    }
}