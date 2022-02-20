import React from "react";

const CreativeInput = (props) => {
    const { fileCount, handleChange } = props;

    return [...Array(fileCount)].map((val, key) => (
        <div className="row mb-3" key={key}>
            <div className="col-12" key={"file_input_" + key}>
                <input
                    type="file"
                    name={"creative_upload[" + key + "]"}
                    onChange={handleChange}
                    className="form-control"
                />
            </div>
        </div>
    ));
};

export default CreativeInput;
